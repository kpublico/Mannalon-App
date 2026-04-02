# Mannalon App - Detailed Process Flow and Role Features

## 1. System Process Flow

### 1.1 Entry and Public Access
1. User opens the app at `/` and sees the landing page.
2. Public routes are available for:
- Login
- Registration

### 1.2 Authentication Flow
1. User submits login credentials.
2. System validates email and password format.
3. System checks:
- User exists
- Password hash matches
- Account status is active
4. System creates authenticated session.
5. Role-based redirect:
- `admin` or `super_admin` -> Admin Dashboard
- `farmer` -> Farmer Home Dashboard

### 1.3 Registration Flow
1. New user submits registration form.
2. System validates required profile fields.
3. System creates user with default role: `farmer`.
4. User is redirected to login page.

### 1.4 Authorization and Middleware Flow
1. After login, all protected routes pass through authentication middleware.
2. Additional role middleware gates modules:
- `checkFarmer` for farmer-only modules
- `checkAdmin` for admin/super-admin modules
- `checkSuperAdmin` for super-admin-only modules

### 1.5 Farmer Module Flow
1. Farmer opens Home Dashboard:
- Displays notice counts and latest commodity update summary.
2. Farmer opens Announcements:
- Filters by audience scope, publish status, active date range, and expiry date.
3. Farmer opens Farming Guides:
- Search and crop-type filtering.
4. Farmer opens Weather:
- Displays weather/alert category advisories from admin announcements.
5. Farmer opens Market Prices:
- Shows latest commodity prices with search.
6. Farmer manages Crop records (CRUD):
- Create -> Validate -> Save
- Update -> Validate -> Save
- Delete
7. Farmer manages Livestock records (CRUD):
- Create -> Validate -> Save
- Update -> Validate -> Save
- Delete
8. Farmer updates own profile/password.

### 1.6 Admin Module Flow
1. Admin opens Admin Dashboard:
- Loads users, farmers, crops, livestock, announcements, guides, and commodity metrics.
2. Admin manages Farmer records:
- List/search farmers
- Create/update/delete farmer profiles
- Upload and store farmer documents
- Update farmer status (`active`, `inactive`, `verified`)
3. Admin manages content:
- Announcements CRUD
- Farming Guides CRUD
- Weather updates
- Market prices maintenance (bulk/page-level and row-level update/delete)
4. Admin monitors:
- All crops
- All livestock
5. Admin reports and exports:
- Reports/analytics page
- CSV export
- PDF export
6. Admin land management and beneficiary distribution:
- Farm details and profile updates
- Beneficiary create/update/delete
- Ayuda status toggling

### 1.7 Super Admin Extension Flow
1. Super admin can access all admin capabilities.
2. Super admin additionally accesses User Management module:
- Create users
- Update users
- Delete users

### 1.8 Messaging and Communication Flow
1. Authenticated user opens Inbox.
2. User can compose:
- Direct message
- Broadcast
- Announcement-type message
3. System validates permission rules by role.
4. System stores messages and recipient mappings.
5. System creates in-app notifications for recipients.
6. Conversation thread flow:
- Start thread
- View threads
- Reply to thread
7. User can mark read, archive, delete, and retrieve messaging statistics.

### 1.9 AI Chatbot Flow
1. Authenticated user sends message to `/api/chat`.
2. System validates message length and format.
3. Chat controller builds response:
- Uses OpenRouter API if key exists
- Falls back to built-in demo logic when API key is missing/fails
4. Bot scope is restricted to:
- Farming/agriculture topics
- Mannalon app navigation guidance
5. Response returns as JSON to frontend chatbot UI.

---

## 2. Role Features Matrix

| Feature Area | Super Admin | Admin | Farmer/User |
|---|---|---|---|
| Login/Logout | Yes | Yes | Yes |
| Registration (public) | Yes (as user) | Yes (as user) | Yes |
| Access Admin Dashboard | Yes | Yes | No |
| Access Farmer Dashboard | If account role is farmer | If account role is farmer | Yes |
| Manage Users (create/update/delete) | Yes | No | No |
| Manage Farmers (CRUD) | Yes | Yes | No |
| Update Farmer Status | Yes | Yes | No |
| Manage Announcements | Yes | Yes | No |
| Manage Farming Guides | Yes | Yes | No |
| Manage Weather Content | Yes | Yes | No |
| Manage Market Prices | Yes | Yes | No |
| Monitor All Crops/Livestock | Yes | Yes | No |
| Reports Analytics + Export (CSV/PDF) | Yes | Yes | No |
| Land Management & Beneficiaries | Yes | Yes | No |
| Manage Own Crops (CRUD) | If role=farmer | If role=farmer | Yes |
| Manage Own Livestock (CRUD) | If role=farmer | If role=farmer | Yes |
| View Announcements/Guides/Weather/Prices | Yes (if using farmer side) | Yes (if using farmer side) | Yes |
| Messaging (inbox, compose, threads, notifications) | Yes | Yes | Yes |
| AI Chatbot Access | Yes (authenticated) | Yes (authenticated) | Yes (authenticated) |

---

## 3. Role Definitions

### 3.1 Super Admin
1. Highest-privilege role.
2. Has all admin features.
3. Exclusive ownership of user-account management for the system.

### 3.2 Admin
1. Operations and content manager role.
2. Owns day-to-day management of farmers, advisories, guides, prices, reports, and land/beneficiary workflows.
3. Cannot access super-admin-only user management.

### 3.3 Farmer/User
1. End-user role focused on farm productivity.
2. Can view advisories and guides, check weather and market prices, manage own crop/livestock records, use messaging, and use chatbot assistance.
3. No admin management permissions.

---

## 4. Notes

1. Effective permissions are enforced by middleware and role checks.
2. Some features are route-protected but still depend on the user role attached to the authenticated account.
3. Messaging permissions include role-based send rules before message dispatch.
