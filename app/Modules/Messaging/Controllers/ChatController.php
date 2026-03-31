<?php

namespace App\Modules\Messaging\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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

2. WEATHER PREPARATION & CLIMATE MANAGEMENT
   - Typhoon readiness, drought management, flood recovery
   - Heavy rainfall: proper drainage, fungal disease prevention

3. MARKET TRENDS & ECONOMICS
   - Price fluctuation factors, seasonality, government procurement programs
   - Post-harvest handling to maximize value

4. FILIPINO AGRICULTURAL CONTEXT
   - Climate: Tropical, wet season (June-Nov), dry season (Dec-May)
   - Common crops: Rice, corn, vegetables
   - Local resources and government programs

RESPONSE GUIDELINES:
- Keep responses under 120 words for mobile readability
- Use simple, farmer-friendly language
- Provide 2-3 actionable steps
- Include safety warnings for chemicals
- Reference local resources";
    }

    /**
     * Send message to AI and get agricultural advice
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
                'reply' => 'I apologize, but I\'m having trouble processing your question right now. Please try again or contact the Municipal Agriculture Office for assistance.'
            ], 500);
        }
    }

    /**
     * Get AI response using OpenAI API
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
                'model' => 'gpt-3.5-turbo',
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
                'temperature' => 0.7,
                'top_p' => 0.9,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? 'No response received.';
            }

            Log::error('OpenAI API Error: ' . $response->body());
            return $this->getDemoResponse($userMessage);

        } catch (\Exception $e) {
            Log::error('OpenAI Connection Error: ' . $e->getMessage());
            return $this->getDemoResponse($userMessage);
        }
    }

    /**
     * Demo/Fallback responses when API is unavailable
     */
    private function getDemoResponse(string $userMessage): string
    {
        $message = strtolower($userMessage);

        // Crop Health Responses
        if (strpos($message, 'pest') !== false || strpos($message, 'insect') !== false) {
            return "For pest control, I recommend:\n\n1. **Identify the pest**: Check pest identification guide\n2. **Organic solution**: Use neem oil spray\n3. **Chemical control**: Use appropriate pesticide with PPE\n\nContact the Municipal Agriculture Office for expert assessment.";
        }

        // Weather Preparation
        if (strpos($message, 'typhoon') !== false || strpos($message, 'storm') !== false) {
            return "**Typhoon Preparation:**\n\n1. **Harvest early** if crops are near maturity\n2. **Improve drainage** to prevent flooding\n3. **Secure structures** and farming equipment\n\nMonitor PAGASA for weather updates.";
        }

        // Default helpful response
        return "Thank you for your question! I can help with:\n\n🌾 Crop Health & Pest Control\n☁️ Weather Preparation\n📈 Market Information\n💧 Farming Techniques\n\nPlease ask about specific farming challenges, or contact the Municipal Agriculture Office.";
    }
}
