# 🌾 Farming Guides System - Visual Flow

## Data Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                    ADMIN SIDE - CREATE GUIDES                  │
├─────────────────────────────────────────────────────────────────┤

    Admin Dashboard
         ↓
    [Farming Guides] Menu
         ↓
    ┌─────────────────────────┐
    │  Create Guide Form       │
    ├─────────────────────────┤
    │ • Title (required)       │
    │ • Crop Type (optional)   │
    │ • Season (optional)      │
    │ • Steps (required)       │
    │ • Video URL (optional)   │  ← CLICK TO ADD VIDEO
    └──────────┬──────────────┘
               │
        [Validate URL]
               │
        ┌──────┴──────┐
        │             │
      VALID        INVALID
        │             │
        ✓             ✗
        │        Show Error
        ↓             
   Save to DB
        │
        ↓
   farming_guides table
        │
    [resource_url: set]
        │
        ↓
   Admin Sees Guide
   in Table with
   YouTube Icon ✓

┌─────────────────────────────────────────────────────────────────┐
│               FARMER SIDE - VIEW & WATCH GUIDES                 │
├─────────────────────────────────────────────────────────────────┤

    Farmer Dashboard
         ↓
    [Farming Guides & 
     Video Tutorials] Menu
         ↓
    Guide List Page
    (Paginated, 12/page)
         ↓
    ┌──────────────────────────────┐
    │  Guide Card                   │
    ├──────────────────────────────┤
    │ 📚 Guide Title               │
    │ 🌾 Crop | 📅 Season | 📅 Date│
    │                              │
    │ [Steps Content]              │
    │ [Pre-formatted Text]         │
    │                              │
    │ ┌────────────────────────┐  │
    │ │  Watch Video Button    │  │ ← RED BUTTON
    │ │  (if resource_url set) │  │   or
    │ │                        │  │   "No Video" (disabled)
    │ └────────────────────────┘  │
    └──────────────┬───────────────┘
                   │
           ┌───────┴───────┐
           │               │
      Video Link      No Video Link
      Exists          Exists
           │               │
        [Click]        [Disabled]
           │
        Opens link
        in NEW TAB
           │
           ↓
      YouTube / Website
      in External Tab
```

---

## Data Structure

### Admin Input → Database
```
FORM INPUT (Admin)
├─ title: "How to Plant Palay"
├─ crop_type: "Palay (Rice)"
├─ season: "Wet Season"
├─ steps: "Step 1: ...\nStep 2: ..."
├─ resource_url: "https://youtube.com/watch?v=..."
└─ posted_by: 1 (admin user ID)

                    ↓ SAVE

DATABASE (farming_guides)
├─ id: 1
├─ title: "How to Plant Palay"
├─ crop_type: "Palay (Rice)"
├─ season: "Wet Season"
├─ steps: "Step 1: ...\nStep 2: ..."
├─ resource_url: "https://youtube.com/watch?v=..."
├─ posted_by: 1
├─ created_at: 2026-03-25 10:30:45
└─ updated_at: 2026-03-25 10:30:45

                    ↓ RETRIEVE

FARMER VIEW (farmer/guides.blade.php)
├─ Display: Guide Title
├─ Display: Crop Type Badge
├─ Display: Season Badge
├─ Display: Last Updated Date
├─ Display: Step-by-step content
└─ Show Button:
    ├─ IF resource_url exists:
    │  └─ "Watch Video" (clickable link)
    └─ ELSE:
       └─ "No Video" (disabled button)
```

---

## Component Relationships

```
┌────────────────────────┐
│  AdminController       │
├────────────────────────┤
│                        │
│ • guidesStore()   ──┐  │
│   - validates      │  │
│   - saves to DB    │  │
│                    │  │
│ • guidesEdit()     │  │
│   - fetch guide    │  │
│   - display form   │  │
│                    │  │
│ • guidesUpdate()   │  │
│   - validates      │  │
│   - updates        │  │
│                    │  │
│ • guidesDestroy()  │  │
│   - delete guide   │  │
│                    │  │
└────────────────────┘  │
                        │
                        └──→ FarmingGuide Model
                              ├─ id
                              ├─ title
                              ├─ crop_type
                              ├─ steps
                              ├─ season
                              ├─ resource_url  ← NEW!
                              ├─ posted_by
                              ├─ created_at
                              └─ updated_at

┌────────────────────────┐
│ DashboardController    │
├────────────────────────┤
│                        │
│ • farmerGuides()       │
│   - fetch guides       │
│   - apply filters      │
│   - paginate (12/page) │
│   - return to view     │
│                        │
└────────┬───────────────┘
         │
         └──→ farmer/guides.blade.php
              ├─ Loop through $guides
              ├─ Display title, crop, season
              ├─ Show steps content
              └─ IF $guide->resource_url
                 └─ Show "Watch Video" button
                    └─ <a href="resource_url" target="_blank">
```

---

## URL Validation Flow

```
User enters URL in form

                ↓

Laravel URL Validator
├─ Must start with http:// or https://
├─ Must be valid domain
├─ Must pass regex checks
└─ Must be ≤ 500 characters

       ↙            ↖
    ERROR          SUCCESS
      │              │
    Show      Save to Database
    Error      (resource_url)
    Message


Validation Examples:

✅ VALID:
   - https://www.youtube.com/watch?v=abc123
   - https://youtu.be/abc123
   - http://example.com/guide
   - https://www.farming-guide.ph/palay

❌ INVALID:
   - youtube.com/video (missing https://)
   - htp://typo.com (typo in protocol)
   - ftp://file.com (FTP not allowed)
   - "just some text" (not a URL)
   - (empty/null is OK - optional field)
```

---

## Video Link Behavior

### Admin Creates Guide with Video

```
FORM with URL: https://www.youtube.com/watch?v=dQw4w9WgXcQ

         ↓ Submit

   Validates URL ✓

         ↓ Save

DATABASE:
  resource_url: "https://www.youtube.com/watch?v=dQw4w9WgXcQ"

         ↓

Admin sees in table:
┌─────────────────────┬──────────┬──────────┐
│ Title               │ Crop     │ Video?   │
├─────────────────────┼──────────┼──────────┤
│ How to Plant Palay  │ Palay    │ 📺 Yes   │
└─────────────────────┴──────────┴──────────┘
               ↓
         ✅ SUCCESS
```

### Farmer Sees Guide Card

```
┌─────────────────────────────────────┐
│ 🌾 How to Plant Palay               │
├─────────────────────────────────────┤
│ 🌾 Palay | 📅 Wet Season | 📅 Today │
│                                       │
│ Step-by-step content...              │
│ 1. Prepare seedbed...               │
│ 2. Soak seeds...                    │
│ [etc.]                              │
│                                       │
│ ┌─────────────────────────────────┐ │
│ │ 📺 Watch Video                  │ │  ← RED BUTTON
│ │ (link: https://youtube.com...)  │ │
│ └─────────────────────────────────┘ │
└─────────────────────────────────────┘
          ↓ User Clicks
       
   Link opens in NEW TAB
       ↓
   YouTube Video Page Opens
       (https://youtube.com/...)
```

### Farmer Sees Guide Without Video

```
┌─────────────────────────────────────┐
│ 🥬 Organic Vegetables               │
├─────────────────────────────────────┤
│ 🥬 Veggies | 📅 Year-Round | 📅 Today│
│                                       │
│ Step-by-step content...              │
│ 1. Prepare compost...               │
│ 2. Plant seeds...                   │
│ [etc.]                              │
│                                       │
│ ┌─────────────────────────────────┐ │
│ │ ⛔ No Video                     │ │  ← GRAYED OUT
│ │ (no link available)             │ │
│ └─────────────────────────────────┘ │
└─────────────────────────────────────┘
       (Button is disabled)
      (User cannot click)
```

---

## Featured Fields

### Video URL Field
```html
<input 
    type="url" 
    name="resource_url" 
    placeholder="https://youtube.com/watch?v=..."
    maxlength="500"
>
```

**Features:**
- HTML5 `type="url"` for native validation
- Placeholder shows example
- MaxLength prevents overly long URLs
- Optional field (can leave blank)
- Validated server-side for security

### Video Button
```html
<!-- WITH VIDEO -->
<a href="{{ $guide->resource_url }}" target="_blank" rel="noopener noreferrer" class="...">
    <i class="fab fa-youtube"></i> Watch Video
</a>

<!-- WITHOUT VIDEO -->
<button disabled class="...">
    <i class="fas fa-ban"></i> No Video
</button>
```

**Features:**
- `target="_blank"` opens in new tab
- `rel="noopener noreferrer"` prevents tab hijacking
- Red styling (YouTube brand)
- Font Awesome YouTube icon
- Clear call-to-action

---

## Test Scenarios

### Scenario 1: Create and View Guide with Video
```
1. Admin logs in
2. Creates guide titled "Palay Planting"
3. Adds YouTube URL: https://youtube.com/watch?v=abc
4. Saves guide

Farmer sees:
├─ Guide card with title and steps
└─ RED "Watch Video" button links to YouTube ✓
```

### Scenario 2: Edit Guide to Add Video
```
1. Admin edits existing guide
2. Adds resource_url: https://youtube.com/watch?v=xyz
3. Updates guide

Farmer sees:
├─ Updated guidance
└─ "Watch Video" button now appears ✓
```

### Scenario 3: Guide Without Video
```
1. Admin creates guide with empty resource_url
2. Saves guide

Farmer sees:
├─ Guide card with all content
└─ GRAYED OUT "No Video" button ✓
```

---

**System Status**: ✅ FULLY OPERATIONAL
