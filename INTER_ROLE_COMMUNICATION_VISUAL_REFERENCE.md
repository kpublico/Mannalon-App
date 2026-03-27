# Inter-Role Communication - Visual Reference Guide

## Role Hierarchy & Communication Flows

```
                    ┌─────────────────┐
                    │   Super Admin    │
                    │   (System Chief) │
                    └────────┬─────────┘
                             │
                ┌────────────┼────────────┐
                │            │            │
                ▼            ▼            ▼
        ┌──────────────┐ ┌──────────────┐
        │   Admin      │ │   Admin      │
        │  (Group A)   │ │  (Group B)   │
        └──────────────┘ └──────────────┘
                │                │
        ┌───────┴────────┐   ┌───┴──────────┐
        │                │   │              │
        ▼                ▼   ▼              ▼
    ┌────────┐      ┌────────┐         ┌────────┐    ┌──────────┐
    │ Farmer │      │ Farmer │         │ Farmer │    │Coordinator
    │  (F1)  │      │  (F2)  │         │  (F3)  │    └──────────┘
    └────────┘      └────────┘         └────────┘
```

## Communication Channels

### 1. Farmer ↔ Farmer
```
Farmer A ──[Direct Message]──> Farmer B
   ■ Peer-to-peer private chat
   ■ Share experiences and solutions
   ■ Discuss crop issues and techniques
```

### 2. Farmer → Admin
```
Farmer ──[Direct Message]──> Admin
   ■ Report issues
   ■ Seek guidance
   ■ Request assistance
   ■ Ask questions
```

### 3. Admin → Farmer (One-to-One)
```
Admin ──[Direct Message]──> Farmer
   ■ Send instructions
   ■ Provide feedback
   ■ Acknowledge reports
   ■ Personal guidance
```

### 4. Admin → Farmer Group (Broadcast)
```
Admin ──[Broadcast]──> [Farmer Group]
                            │
                    ┌───────┼───────┐
                    ▼       ▼       ▼
                  Farmer  Farmer  Farmer
   ■ Group announcements
   ■ Weather updates
   ■ Market prices
   ■ Training notices
```

### 5. Admin ↔ Admin
```
Admin A ──[Direct Message]──> Admin B
   ■ Coordinate activities
   ■ Share information
   ■ Discuss strategies
   ■ Peer support
```

### 6. Admin → Super Admin
```
Admin ──[Direct Message]──> Super Admin
   ■ Report status
   ■ Request approvals
   ■ Escalate issues
   ■ Share metrics
```

### 7. Super Admin → Admin (One-to-One or Group)
```
Super Admin ──[Direct]──> Admin         OR    Super Admin ──[Broadcast]──> All Admins
   ■ Direct orders                            ■ System-wide policies
   ■ Policy changes                           ■ Strategic directives
   ■ Performance feedback                     ■ Important announcements
```

### 8. Super Admin → Farmer (System Announcement)
```
Super Admin ──[Announcement]──> All Farmers
   ■ Critical alerts
   ■ System maintenance
   ■ Major policy changes
   ■ Emergency notifications
```

### 9. Farmer ↔ Coordinator
```
Farmer ──[Direct Message]──> Coordinator
   ■ Get support
   ■ Technical assistance
   ■ Resource requests
```

### 10. Admin ↔ Coordinator
```
Admin ──[Direct Message]──> Coordinator
   ■ Coordinate activities
   ■ Task delegation
   ■ Information sharing
```

## Message Type Flow Diagram

```
                    Message Types
                          │
        ┌─────────────────┼─────────────────┬────────────┐
        │                 │                 │            │
        ▼                 ▼                 ▼            ▼
    DIRECT          BROADCAST         ANNOUNCEMENT      ALERT
  (1-to-1)         (1-to-Group)      (System-wide)   (System)
        │                 │                 │            │
        │                 │                 │            │
    └─ Farmer-Admin    Admin→     Super Admin →      System
    └─ Farmer-Farmer   Farmers    All Farmers      Generated
    └─ Admin-Admin   (Group A)                     Automatic
    └─ Admin-Farmer                                  Events
    └─ Any-Any
       (Permitted)
```

## Permission Matrix

```
FROM/TO      Farmer    Admin   Super_Admin   Coordinator
─────────────────────────────────────────────────────────
Farmer:      Direct    Direct      -          Direct
Admin:      Direct✱    Direct     Direct      Direct
           Broadcast
Super Admin: Announce  Direct✱      -           -
            Broadcast
Coordinator: Direct    Direct      -          Direct

✱ = Primary communication channel
- = Not permitted
Direct = One-to-one private message
Broadcast = One-to-many group message
Announce = System-wide announcement
```

## Priority Levels & Usage

```
URGENT
  │
  ├─ Critical issues requiring immediate action
  ├─ Security breaches
  ├─ System outages
  ├─ Emergency alerts
  │
NORMAL (Most common)
  │
  ├─ Regular updates
  ├─ Routine guidance
  ├─ Standard reports
  ├─ General announcements
  │
LOW
  │
  ├─ General information
  ├─ FYI messages
  ├─ Archive guidelines
  └─ Reference materials
```

## Conversation Thread Flow

```
Initiator                 Participants
    │                          │
    └──────► Start Thread ◄─────┘
              (Title, Description)
                    │
                    ▼
             Add Participants
                    │
    ┌───────────────┼───────────────┐
    ▼               ▼               ▼
  Reply 1        Reply 2        Reply 3
  (User A)       (User B)       (User A)
    │               │               │
    └───────────────┼───────────────┘
                    │
             Update Thread
        (Last message, activity)
                    │
                    ▼
      Can be muted, closed, archived
```

## Real-World Usage Scenarios

### Scenario 1: Crop Disease Report
```
Farmer F1
  └─► DIRECT MESSAGE ──> Admin A
       "My rice has brown spots. What should I do?"
       [Priority: Normal]
       
Admin A
  └─► DIRECT MESSAGE ──> Farmer F1
       "This is rice blast. Use fungicide XYZ. See guide link."
       [Priority: Normal]

Admin A
  └─► BROADCAST ──> Group A (All Farmers)
       "Rice Blast Alert: Several farmers reporting spotted rice.
        Use recommended fungicide. Contact me for details."
       [Priority: High]
```

### Scenario 2: Emergency Weather Alert
```
Super Admin
  └─► ANNOUNCEMENT ──> All Farmers
       "TYPHOON WARNING: Prepare fields. Harvest early if
        possible. Secure structures. Updates at 6 PM daily."
       [Priority: Urgent]

Admin A
  └─► BROADCAST ──> Group A
       "Local preparations: Meet at center tomorrow 9 AM.
        Bring equipment. Emergency supplies distributed."
       [Priority: Urgent]
```

### Scenario 3: Multi-Admin Coordination
```
Admin A
  └─► START THREAD ──> Admin B, Admin C
       Title: "End of Season Planning"
       Description: "Discuss crop rotation and next planting"

Admin B
  └─► REPLY
       "I suggest rotating Group B's rice field to corn."

Admin C
  └─► REPLY
       "Agreed. What about fertilizer procurement?"

Admin A
  └─► REPLY
       "I'll check budgets. Thread closed once confirmed."
       (Thread → CLOSED)
```

### Scenario 4: Farmer Support Network
```
Farmer F2
  └─► START THREAD ──> Coordinator, Admin
       "Question: Corn planting schedule and spacing"

Coordinator
  └─► REPLY
       "Standard spacing is 75cm. Here's the schedule..."

Farmer F2
  └─► REPLY
       "Clear. Thanks! So 3 seeds per hole?"

Coordinator
  └─► REPLY
       "Yes, exact. Let me know if you need more help."
```

## System Integration Points

```
                   Messaging System
                          │
        ┌─────────────────┼─────────────────┐
        │                 │                 │
        ▼                 ▼                 ▼
      User Auth        Farmer Groups      Announcements
        │                 │                 │
        ├─ Roles ────────┤                 ├─ Feed
        ├─ Profiles      ├─ Members        ├─ History
        └─ Sessions      └─ Management     └─ Replies
                                
        │                 │                 │
        ▼                 ▼                 ▼
      Admin Setup      Crop Reports       Audit Logs
        │                 │                 │
        ├─ Users ────────┤                 ├─ Track actions
        ├─ Permissions   ├─ Crop data      ├─ Archive
        └─ Roles         └─ Status         └─ Compliance
```

## Data Flow for Sending a Broadcast

```
1. Admin Creates Message
   ├─ Validates permission (Admin→Farmer, Broadcast method)
   └─ Creates Message record
   
2. Get Recipients
   ├─ Fetch FarmerGroup
   ├─ Get Farmers in group
   └─ Collect User IDs
   
3. Create Recipients
   ├─ MessageRecipient entries for each farmer
   ├─ Set is_read = false
   └─ Set recipient_role = 'farmer'
   
4. Generate Notifications
   ├─ Create Notification record for each recipient
   ├─ Set channel = 'in_app'
   └─ Track delivery timestamp
   
5. Update Dashboard
   ├─ Increment unread count
   ├─ Display in inbox
   └─ Send notification bell alert
   
6. User Actions
   ├─ Farmer receives notification
   ├─ Farmer reads message
   ├─ Mark read in Message/MessageRecipient
   └─ Can archive or reply
```

## Permission Check Flowchart

```
                    User sends message
                            │
                    ┌───────┴────────┐
                    ▼                ▼
            Direct Message?    Broadcast/Announce?
                    │                │
                    ▼                ▼
            Find Recipient        Get Group
                    │                │
                    ▼                ▼
         ┌─ Recipient Role    ┌─ Group Members
         │                    │
         ▼                    ▼
    Check Permission    Check Permission
   (sender_role,       (sender_role,
    recipient_role,    'farmer',
    'direct')         'broadcast')
         │                    │
       YES/NO              YES/NO
         │                    │
    ┌────┴────┐           ┌──┴──┐
    ▼         ▼           ▼     ▼
  ALLOW     DENY        ALLOW  DENY
  Send     Error        Send   Error
   msg                   msg
```

## File Structure

```
Mannalon_App/
├── app/
│   ├── Models/
│   │   ├── Message.php
│   │   ├── Notification.php
│   │   ├── MessageRecipient.php
│   │   ├── CommunicationPermission.php
│   │   ├── ConversationThread.php
│   │   └── ThreadParticipant.php
│   ├── Http/Controllers/
│   │   └── MessagingController.php
│   ├── Policies/
│   │   ├── MessagePolicy.php
│   │   ├── ConversationThreadPolicy.php
│   │   └── NotificationPolicy.php
│   ├── Services/
│   │   └── MessagingService.php
│   ├── Traits/
│   │   └── RoleMessagingTrait.php
│   └── Providers/
│       └── AppServiceProvider.php (updated)
├── database/
│   └── migrations/
│       ├── 2026_03_25_130000_create_messages_system_tables.php
│       └── 2026_03_25_130100_seed_communication_permissions.php
├── routes/
│   └── web.php (updated with messaging routes)
├── INTER_ROLE_COMMUNICATION_GUIDE.md
└── INTER_ROLE_COMMUNICATION_IMPLEMENTATION.md
```

## Quick Reference: Available Methods

```php
// On User model (via RoleMessagingTrait)
$user->getAvailableRecipientRoles()
$user->getAvailableMethods($role)
$user->canSendDirectMessageTo($recipient)
$user->canSendBroadcast()
$user->canSendAnnouncements()
$user->sendDirectMessage($recipient, $subject, $content)
$user->sendBroadcastToGroup($grou pId, $subject, $content)
$user->sendSystemAnnouncement($subject, $content)
$user->getUnreadMessageCount()
$user->getRecentMessages($limit)

// Using MessagingService
MessagingService::sendMessage($sender, $data)
MessagingService::getInbox($user, $filters)
MessagingService::getThreads($user, $filters)
MessagingService::createThread($initiator, $data)
MessagingService::replyToThread($replier, $thread, $content)
MessagingService::getStatistics($user)
MessagingService::getRoleCapabilities($role)
MessagingService::searchMessages($user, $query)
```

---

*This visual guide represents the complete inter-role communication system design. Refer to INTER_ROLE_COMMUNICATION_GUIDE.md for detailed implementation information.*
