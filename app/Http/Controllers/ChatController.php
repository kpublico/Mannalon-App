<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Expert Agricultural AI System Prompt
     * This defines the AI's personality, expertise, and behavior
     */
    private function getSystemPrompt(): string
    {
        return "You are a professional Agricultural Extension Officer and expert advisor for MannalonApp, serving farmers in Cagayan Province, Philippines.

CORE EXPERTISE:
1. CROP HEALTH & PEST MANAGEMENT
   - Rice: Stem borers, brown planthoppers, blast disease, bacterial leaf blight
   - Corn: Fall armyworm, corn borer, downy mildew, rust
   - Vegetables: Aphids, whiteflies, bacterial wilt, fungal diseases
   - Provide identification tips, organic solutions, and chemical treatments with safety warnings

2. WEATHER PREPARATION
   - Typhoon readiness: harvesting early, securing structures, drainage preparation
   - Drought management: water conservation, drought-resistant varieties, mulching
   - Flood recovery: field drying, replanting strategies, disease prevention
   - Heavy rainfall: proper drainage, fungal disease prevention

3. MARKET TRENDS & ECONOMICS
   - Price fluctuation factors: supply/demand, seasonality, weather impacts
   - Best selling times for crops
   - Government procurement programs
   - Post-harvest handling to maximize value

4. FILIPINO AGRICULTURAL CONTEXT
   - Climate: Tropical, wet season (June-Nov), dry season (Dec-May)
   - Common crops: Rice, corn, vegetables (tomato, eggplant, bitter gourd)
   - Local resources: Municipal Agriculture Office, PAGASA, PCIC insurance
   - Government programs: Fertilizer subsidy, crop insurance, trainings

RESPONSE GUIDELINES:
- Keep responses under 120 words for mobile readability
- Use simple, farmer-friendly language (avoid technical jargon)
- Provide 2-3 actionable steps when giving advice
- Include safety warnings for pesticides/chemicals
- Reference local resources: Municipal Agriculture Office (078) 123-4567
- Be encouraging and supportive in tone
- Use metric system: hectares, kilograms, Celsius

HANDLING OFF-TOPIC QUESTIONS:
If users ask about entertainment, politics, personal matters, or non-agricultural topics, politely redirect:
'I specialize in agricultural advice for farmers in Cagayan. I can help with crop cultivation, pest control, weather preparation, and market information. How can I assist with your farming needs today?'

LIMITATIONS:
- For complex legal/land issues: Direct to Municipal Agriculture Office
- For human health concerns: Recommend proper medical professionals
- For emergency disasters: Reference PAGASA and local disaster response
- Never guarantee specific yields or profits
- When uncertain, admit limitations and suggest expert consultation

SAFETY PRIORITY:
- Always emphasize personal protective equipment for chemical use
- Warn about pesticide toxicity and proper handling
- Recommend organic/sustainable methods when applicable
- Stress proper storage of chemicals away from food and children";
    }

    /**
     * Send message to AI and get agricultural advice
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:500|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'reply' => 'Please enter a valid question (3-500 characters).'
            ], 422);
        }

        $userMessage = $request->input('message');

        try {
            // Get AI response
            $aiResponse = $this->getAIResponse($userMessage);

            return response()->json([
                'success' => true,
                'reply' => $aiResponse
            ]);

        } catch (\Exception $e) {
            Log::error('Chat AI Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'reply' => 'I apologize, but I\'m having trouble processing your question right now. Please try again or contact the Municipal Agriculture Office at (078) 123-4567 for immediate assistance.'
            ], 500);
        }
    }

    /**
     * Get AI response using OpenAI API
     * 
     * @param string $userMessage
     * @return string
     */
    private function getAIResponse(string $userMessage): string
    {
        $apiKey = env('OPENAI_API_KEY');

        // Fallback to demo mode if no API key configured
        if (empty($apiKey)) {
            return $this->getDemoResponse($userMessage);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo', // or 'gpt-4' for better quality
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $this->getSystemPrompt()
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'max_tokens' => 300,
                'temperature' => 0.7, // Balance between creativity and consistency
                'top_p' => 0.9,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? 'No response received.';
            }

            // Log API error
            Log::error('OpenAI API Error: ' . $response->body());
            return $this->getDemoResponse($userMessage);

        } catch (\Exception $e) {
            Log::error('OpenAI Connection Error: ' . $e->getMessage());
            return $this->getDemoResponse($userMessage);
        }
    }

    /**
     * Demo/Fallback responses when API is unavailable
     * 
     * @param string $userMessage
     * @return string
     */
    private function getDemoResponse(string $userMessage): string
    {
        $message = strtolower($userMessage);

        // Crop Health Responses
        if (strpos($message, 'pest') !== false || strpos($message, 'insect') !== false || strpos($message, 'bug') !== false) {
            return "For pest control, I recommend:\n\n1. **Identify the pest**: Check if it's stem borer, aphids, or armyworm\n2. **Organic solution**: Use neem oil spray or introduce natural predators\n3. **Chemical control**: If severe, use appropriate pesticide with proper protective equipment\n\nVisit our Farming Guides section for detailed pest identification, or contact the Municipal Agriculture Office at (078) 123-4567 for expert assessment.";
        }

        if (strpos($message, 'disease') !== false || strpos($message, 'sick') !== false || strpos($message, 'yellow') !== false) {
            return "For crop diseases:\n\n1. **Remove affected plants** immediately to prevent spread\n2. **Improve drainage** - many diseases thrive in wet conditions\n3. **Apply fungicide** if it's a fungal infection, following safety instructions\n\nCommon diseases in Cagayan: bacterial leaf blight (rice), downy mildew (corn). Check the Farming Guides section or consult the Municipal Agriculture Office for specific treatment plans.";
        }

        // Weather Preparation
        if (strpos($message, 'typhoon') !== false || strpos($message, 'storm') !== false || strpos($message, 'bagyo') !== false) {
            return "**Typhoon Preparation:**\n\n1. **Harvest early** if crops are near maturity\n2. **Improve drainage** to prevent flooding\n3. **Secure structures** and farming equipment\n4. **Monitor PAGASA** for weather updates\n\nAfter the typhoon, check for standing water and apply fungicide to prevent diseases. Check our Weather Info section for real-time forecasts.";
        }

        if (strpos($message, 'drought') !== false || strpos($message, 'dry') !== false || strpos($message, 'water') !== false) {
            return "**Drought Management:**\n\n1. **Mulching**: Cover soil to retain moisture\n2. **Early morning watering**: Reduce evaporation\n3. **Drought-resistant varieties**: Consider planting next season\n4. **Drip irrigation**: More efficient than flooding\n\nConserve water by removing weeds that compete for moisture. Contact the Municipal Agriculture Office about water-saving techniques and available assistance.";
        }

        // Market & Economics
        if (strpos($message, 'price') !== false || strpos($message, 'market') !== false || strpos($message, 'sell') !== false) {
            return "**Market Strategy:**\n\n1. **Check Market Prices section** in MannalonApp for current rates\n2. **Time your harvest**: Prices peak during off-season\n3. **Quality matters**: Clean, uniform produce gets better prices\n4. **Government programs**: Check for procurement opportunities\n\nPrice fluctuations depend on supply, weather, and demand. Visit the Market Prices section for real-time updates and trends.";
        }

        // Rice Specific
        if (strpos($message, 'rice') !== false || strpos($message, 'palay') !== false) {
            return "**Rice Cultivation Tips:**\n\n1. **Planting**: Best during June-July (wet season)\n2. **Water management**: Maintain 2-5cm water level during vegetative stage\n3. **Fertilization**: Apply at 14, 30, and 50 days after transplanting\n4. **Harvest timing**: When 80% of grains are golden yellow\n\nCommon issues: stem borers, blast disease, brown planthoppers. Check the Farming Guides section for detailed rice cultivation information.";
        }

        // Corn Specific
        if (strpos($message, 'corn') !== false || strpos($message, 'mais') !== false) {
            return "**Corn Cultivation Tips:**\n\n1. **Planting**: Dry season (January-March) is ideal\n2. **Spacing**: 75cm between rows, 25cm between plants\n3. **Fertilizer**: Apply at 14, 30, and 45 days after planting\n4. **Pest control**: Watch for fall armyworm and corn borer\n\nUse hybrid varieties for better yield. Apply organic matter to improve soil health. Visit Farming Guides for detailed corn production techniques.";
        }

        // Fertilizer
        if (strpos($message, 'fertilizer') !== false || strpos($message, 'nutrient') !== false || strpos($message, 'pataba') !== false) {
            return "**Fertilizer Application:**\n\n1. **Soil test first**: Know what nutrients are needed\n2. **Timing matters**: Split applications for better absorption\n3. **Organic options**: Compost, vermicast, animal manure\n4. **Government subsidy**: Check announcements for free fertilizer programs\n\nAvoid over-fertilization as it can harm crops and pollute water. Contact the Municipal Agriculture Office about the current fertilizer subsidy program.";
        }

        // Planting/Growing
        if (strpos($message, 'plant') !== false || strpos($message, 'grow') !== false || strpos($message, 'tanim') !== false) {
            return "**General Planting Guidance:**\n\n1. **Choose the right season**: Wet season for rice, dry season for corn\n2. **Prepare the soil**: Plow, harrow, and apply organic matter\n3. **Use quality seeds**: Certified seeds have better germination\n4. **Proper spacing**: Prevents disease spread and allows growth\n\nWhat specific crop are you planning to grow? I can provide detailed guidance for rice, corn, or vegetables. Also check our Farming Guides section.";
        }

        // Off-topic redirect
        if (strpos($message, 'movie') !== false || strpos($message, 'game') !== false || 
            strpos($message, 'politics') !== false || strpos($message, 'song') !== false) {
            return "I appreciate your question, but I specialize in agricultural advice for farmers in Cagayan Province. I can help with:\n\n🌾 Crop cultivation (rice, corn, vegetables)\n🐛 Pest and disease management\n☁️ Weather preparation\n📈 Market trends and pricing\n💧 Irrigation and fertilization\n\nHow can I assist with your farming needs today?";
        }

        // Default helpful response
        return "Thank you for your question! As your agricultural assistant, I can help with:\n\n🌾 **Crop Health**: Identifying pests and diseases\n☁️ **Weather Prep**: Typhoon and drought readiness\n📈 **Market Info**: Pricing trends and selling strategies\n💧 **Farming Techniques**: Planting, irrigation, fertilization\n\nPlease ask about specific farming challenges, or visit our Farming Guides section. You can also contact the Municipal Agriculture Office at (078) 123-4567 for personalized guidance.";
    }
}
