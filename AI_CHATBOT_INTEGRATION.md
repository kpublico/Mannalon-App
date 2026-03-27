# Mannalon AI Assistant - Integration Guide

## Overview
The Mannalon AI Assistant is an agricultural chatbot designed to help farmers with crop cultivation, weather preparation, market trends, and general farming advice specific to Cagayan Province, Philippines.

---

## 🤖 AI System Prompt (LLM Configuration)

Use this system prompt when integrating with GPT-4, GPT-3.5, Claude, Gemini, or other LLMs:

```
You are the Mannalon Agricultural Assistant, an expert AI advisor for farmers in Cagayan Province, Philippines. Your role is to provide accurate, practical, and locally-relevant agricultural guidance.

CORE EXPERTISE AREAS:
1. Crop Cultivation (rice, corn, vegetables, fruits)
2. Weather Preparation & Climate Adaptation
3. Market Trends & Pricing Information
4. Pest & Disease Management
5. Irrigation & Water Management
6. Soil Health & Fertilization
7. Organic Farming Practices
8. Government Agricultural Programs

GUIDELINES:
- Provide concise, actionable advice suitable for Filipino farmers
- Consider Cagayan Province's tropical climate (wet season: June-November, dry season: December-May)
- Reference local resources: Municipal Agriculture Office, Philippine Crop Insurance (PCIC), PAGASA weather updates
- Use metric measurements (hectares, kilograms, Celsius)
- Include safety warnings when discussing pesticides or chemicals
- Recommend sustainable and organic practices when applicable
- Be encouraging and supportive in tone

RESPONSE FORMAT:
- Keep responses under 150 words
- Use bullet points for lists
- Include practical next steps
- Reference relevant sections of MannalonApp when applicable (Weather Info, Market Prices, Farming Guides)

LIMITATIONS:
- If unsure, direct users to contact the Municipal Agriculture Office at (078) 123-4567
- Do not provide medical advice for humans
- Do not guarantee specific yields or profits
- Recommend professional consultation for complex issues

EMERGENCY SITUATIONS:
- For typhoons/severe weather: Refer to PAGASA and local disaster response
- For disease outbreaks: Recommend immediate reporting to agriculture office
- For food safety issues: Direct to proper authorities
```

---

## 📡 API Integration Options

### Option 1: OpenAI API (GPT-4 / GPT-3.5)

**Backend Route (Laravel):**
```php
// routes/web.php
Route::post('/api/chat', [ChatController::class, 'sendMessage'])->middleware('auth');
```

**Controller (app/Http/Controllers/ChatController.php):**
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $systemPrompt = "You are the Mannalon Agricultural Assistant, an expert AI advisor for farmers in Cagayan Province, Philippines...";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $request->message]
                ],
                'max_tokens' => 250,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'reply' => $data['choices'][0]['message']['content']
                ]);
            }

            return response()->json(['error' => 'Failed to get response'], 500);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 500);
        }
    }
}
```

**Environment Configuration (.env):**
```env
OPENAI_API_KEY=your_openai_api_key_here
```

**Frontend JavaScript Update:**
```javascript
// Replace the getAIResponse function with actual API call
async function sendMessageToAPI(message) {
    try {
        const response = await fetch('/api/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message: message })
        });

        const data = await response.json();
        return data.reply || 'Sorry, I could not process your request.';
        
    } catch (error) {
        console.error('Chat error:', error);
        return 'Connection error. Please try again later.';
    }
}

// Update the sendMessage function to use API
function sendMessage(event) {
    event.preventDefault();
    
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (!message) return;
    
    addMessageToChat(message, 'user');
    input.value = '';
    showTypingIndicator();
    
    // Call actual API
    sendMessageToAPI(message).then(aiResponse => {
        hideTypingIndicator();
        addMessageToChat(aiResponse, 'ai');
    });
}
```

---

### Option 2: Google Gemini API

**Controller Method:**
```php
public function sendMessage(Request $request)
{
    $request->validate(['message' => 'required|string|max:500']);

    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}";

    $systemPrompt = "You are the Mannalon Agricultural Assistant...";
    $fullPrompt = $systemPrompt . "\n\nUser Question: " . $request->message;

    try {
        $response = Http::timeout(30)->post($url, [
            'contents' => [
                ['parts' => [['text' => $fullPrompt]]]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
            
            return response()->json(['reply' => $reply]);
        }

        return response()->json(['error' => 'Failed to get response'], 500);
        
    } catch (\Exception $e) {
        return response()->json(['error' => 'Service unavailable'], 500);
    }
}
```

---

### Option 3: Anthropic Claude API

**Controller Method:**
```php
public function sendMessage(Request $request)
{
    $request->validate(['message' => 'required|string|max:500']);

    $systemPrompt = "You are the Mannalon Agricultural Assistant...";

    try {
        $response = Http::withHeaders([
            'x-api-key' => env('ANTHROPIC_API_KEY'),
            'anthropic-version' => '2023-06-01',
            'content-type' => 'application/json',
        ])->timeout(30)->post('https://api.anthropic.com/v1/messages', [
            'model' => 'claude-3-sonnet-20240229',
            'max_tokens' => 300,
            'system' => $systemPrompt,
            'messages' => [
                ['role' => 'user', 'content' => $request->message]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $reply = $data['content'][0]['text'] ?? 'No response';
            
            return response()->json(['reply' => $reply]);
        }

        return response()->json(['error' => 'Failed to get response'], 500);
        
    } catch (\Exception $e) {
        return response()->json(['error' => 'Service unavailable'], 500);
    }
}
```

---

## 🎨 UI Components Included

### Floating Chat Button
- **Position:** Fixed bottom-right corner
- **Style:** Circular, emerald green, with chat icon
- **Behavior:** Toggles chat window visibility
- **Hover Effect:** Scales up 10%

### Chat Window
- **Dimensions:** 384px wide × 600px tall
- **Position:** Bottom-right, above button
- **Components:**
  - Header with AI branding
  - Scrollable message area
  - Input field with send button
  - Welcome message with capabilities

### Features
✅ Smooth open/close animations  
✅ Typing indicator with bouncing dots  
✅ User messages (right-aligned, emerald)  
✅ AI messages (left-aligned, white)  
✅ Auto-scroll to latest message  
✅ XSS protection with HTML escaping  
✅ Mobile-responsive design  

---

## 🔒 Security Considerations

1. **Rate Limiting:** Add rate limiting to prevent API abuse
2. **Input Validation:** Sanitize all user inputs
3. **CSRF Protection:** Include CSRF tokens in API calls
4. **API Key Security:** Store API keys in `.env`, never commit to git
5. **Response Filtering:** Monitor for inappropriate AI responses

---

## 💰 Cost Estimation

### OpenAI GPT-3.5 Turbo
- **Cost:** $0.0015 per 1K tokens input, $0.002 per 1K tokens output
- **Average query:** ~150 tokens input + 200 tokens output = ~$0.0007 per message
- **1000 messages/month:** ~$0.70

### Google Gemini Pro
- **Free tier:** 60 requests per minute
- **Paid:** $0.00025 per 1K characters
- **Very cost-effective for moderate usage**

### Anthropic Claude
- **Cost:** $0.003 per 1K tokens input, $0.015 per 1K tokens output
- **Higher quality but more expensive**

---

## 📝 Testing the Chatbot

**Sample Questions to Test:**
1. "How do I plant rice in Cagayan?"
2. "What should I do about stem borers in my corn?"
3. "When is the best time to harvest?"
4. "What are the current market prices?"
5. "How to prepare for typhoon season?"

---

## 🚀 Deployment Checklist

- [ ] Add API key to `.env` file
- [ ] Create ChatController
- [ ] Add route to `web.php`
- [ ] Update frontend JavaScript with API calls
- [ ] Add CSRF token meta tag to layout
- [ ] Test with various questions
- [ ] Set up rate limiting
- [ ] Monitor API usage and costs
- [ ] Add error logging
- [ ] Create fallback responses for API failures

---

## 📞 Support

For technical issues or questions about the AI integration:
- Contact: MannalonApp Development Team
- Email: support@mannalonapp.ph
- Phone: (078) 123-4567

---

**Last Updated:** January 28, 2026
