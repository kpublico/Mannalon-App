/**
 * MannalonApp - Admin Panel Mock Data
 * Realistic agricultural dashboard data for Filipino farmers
 * Generated: January 29, 2026
 */

// ============================================================================
// SUMMARY STATISTICS - Today's Overview
// ============================================================================
export const summaryStats = {
  newRegistrations: 12,
  postsPublished: 5,
  supportTickets: 3,
  totalFarmers: 245,
  verifiedFarmers: 218,
  pendingVerification: 27,
  activeSessions: 87,
  lastUpdated: new Date().toLocaleString('en-US', { 
    month: 'short', 
    day: 'numeric', 
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
};

// ============================================================================
// RECENT FARMERS - Latest Registrations
// ============================================================================
export const recentFarmers = [
  {
    id: 1,
    name: 'Juan Dela Cruz',
    email: 'juan.delacruz@email.com',
    phone: '+63-921-234-5678',
    location: 'Aparri, Cagayan',
    farmSize: '5.2 hectares',
    crops: ['Rice', 'Corn', 'Vegetables'],
    dateJoined: 'Jan 29, 2026',
    status: 'Active',
    verificationStatus: 'Verified',
    crops_count: 3
  },
  {
    id: 2,
    name: 'Maria Santos',
    email: 'maria.santos@email.com',
    phone: '+63-917-876-5432',
    location: 'Solano, Nueva Vizcaya',
    farmSize: '3.8 hectares',
    crops: ['Vegetables', 'Root Crops'],
    dateJoined: 'Jan 27, 2026',
    status: 'Active',
    verificationStatus: 'Verified',
    crops_count: 2
  },
  {
    id: 3,
    name: 'Rajesh Perera',
    email: 'rajesh.perera@email.com',
    phone: '+63-908-345-6789',
    location: 'La Trinidad, Benguet',
    farmSize: '2.1 hectares',
    crops: ['Potatoes', 'Cabbage', 'Carrots'],
    dateJoined: 'Jan 25, 2026',
    status: 'Active',
    verificationStatus: 'Pending',
    crops_count: 3
  },
  {
    id: 4,
    name: 'Amara Bandara',
    email: 'amara.bandara@email.com',
    phone: '+63-916-567-8901',
    location: 'Jaro, Iloilo',
    farmSize: '1.5 hectares',
    crops: ['Mango', 'Coconut', 'Banana'],
    dateJoined: 'Jan 23, 2026',
    status: 'Active',
    verificationStatus: 'Verified',
    crops_count: 3
  },
  {
    id: 5,
    name: 'Priya Nayak',
    email: 'priya.nayak@email.com',
    phone: '+63-919-789-0123',
    location: 'Cabanatuan, Nueva Ecija',
    farmSize: '4.3 hectares',
    crops: ['Rice', 'Corn'],
    dateJoined: 'Jan 21, 2026',
    status: 'Active',
    verificationStatus: 'Verified',
    crops_count: 2
  }
];

// ============================================================================
// MARKET PRICES - Real-time Commodity Data (PHP)
// ============================================================================
export const marketPrices = [
  {
    id: 1,
    commodity: 'Rice (Milled)',
    currentPrice: 85.50,
    previousPrice: 82.00,
    priceChange: 3.50,
    percentChange: 4.3,
    trend: 'up',
    unit: 'per kg',
    source: 'Central Market, Metro Manila',
    lastUpdated: 'Jan 29, 2026, 10:30 AM',
    highPrice: 88.00,
    lowPrice: 80.00,
    priceHistory: [82, 81.5, 82.5, 83, 84.5, 85.50]
  },
  {
    id: 2,
    commodity: 'Corn (Yellow)',
    currentPrice: 35.00,
    previousPrice: 36.50,
    priceChange: -1.50,
    percentChange: -4.1,
    trend: 'down',
    unit: 'per kg',
    source: 'Regional Market, Cagayan Valley',
    lastUpdated: 'Jan 29, 2026, 09:45 AM',
    highPrice: 37.50,
    lowPrice: 33.50,
    priceHistory: [36.5, 36.2, 36.8, 36.5, 35.8, 35]
  },
  {
    id: 3,
    commodity: 'Onion (White)',
    currentPrice: 120.00,
    previousPrice: 115.00,
    priceChange: 5.00,
    percentChange: 4.3,
    trend: 'up',
    unit: 'per kg',
    source: 'Mindanao Regional Center',
    lastUpdated: 'Jan 29, 2026, 08:15 AM',
    highPrice: 125.00,
    lowPrice: 110.00,
    priceHistory: [115, 116, 118, 119, 119.5, 120]
  },
  {
    id: 4,
    commodity: 'Potato',
    currentPrice: 42.50,
    previousPrice: 43.00,
    priceChange: -0.50,
    percentChange: -1.2,
    trend: 'down',
    unit: 'per kg',
    source: 'Benguet Trading Post',
    lastUpdated: 'Jan 29, 2026, 11:00 AM',
    highPrice: 45.00,
    lowPrice: 40.00,
    priceHistory: [43, 42.8, 42.9, 42.7, 42.6, 42.5]
  },
  {
    id: 5,
    commodity: 'Tomato',
    currentPrice: 55.75,
    previousPrice: 52.00,
    priceChange: 3.75,
    percentChange: 7.2,
    trend: 'up',
    unit: 'per kg',
    source: 'Laspinas Market',
    lastUpdated: 'Jan 29, 2026, 07:30 AM',
    highPrice: 58.00,
    lowPrice: 50.00,
    priceHistory: [52, 52.5, 53, 54, 55, 55.75]
  }
];

// ============================================================================
// SYSTEM HEALTH - Infrastructure Status
// ============================================================================
export const systemHealth = [
  {
    component: 'Database',
    status: 'Operational',
    statusCode: 'operational',
    uptime: '99.9%',
    responseTime: '12ms',
    lastCheck: 'Just now',
    indicator: 'green',
    details: 'MySQL Primary (192.168.1.100)'
  },
  {
    component: 'Server',
    status: 'Operational',
    statusCode: 'operational',
    uptime: '99.95%',
    responseTime: '8ms',
    lastCheck: 'Just now',
    indicator: 'green',
    details: 'PHP 8.2.12 - Apache 2.4'
  },
  {
    component: 'API',
    status: 'Operational',
    statusCode: 'operational',
    uptime: '99.8%',
    responseTime: '15ms',
    lastCheck: '2 minutes ago',
    indicator: 'green',
    details: 'Laravel API v1.0'
  },
  {
    component: 'Cache',
    status: 'Operational',
    statusCode: 'operational',
    uptime: '100%',
    responseTime: '2ms',
    lastCheck: 'Just now',
    indicator: 'green',
    details: 'Redis Memory Cache'
  },
  {
    component: 'Email Service',
    status: 'Operational',
    statusCode: 'operational',
    uptime: '99.7%',
    responseTime: '245ms',
    lastCheck: '5 minutes ago',
    indicator: 'green',
    details: 'SMTP - 412 emails sent today'
  },
  {
    component: 'Storage',
    status: 'Warning',
    statusCode: 'warning',
    usage: '75%',
    available: '1.25 GB / 5 GB',
    lastCheck: 'Just now',
    indicator: 'yellow',
    details: 'Consider cleanup or upgrade'
  }
];

// ============================================================================
// ACTIVITY METRICS - Engagement & Completion
// ============================================================================
export const activityMetrics = [
  {
    label: 'User Engagement',
    percentage: 78,
    color: 'emerald',
    target: 85,
    description: 'Active users vs total registered',
    details: '215 active / 245 total users'
  },
  {
    label: 'Crop Data Completion',
    percentage: 65,
    color: 'blue',
    target: 90,
    description: 'Crop profiles with complete information',
    details: '598 complete / 920 total records'
  },
  {
    label: 'Livestock Data Completion',
    percentage: 82,
    color: 'orange',
    target: 95,
    description: 'Livestock records with full details',
    details: '742 complete / 905 total records'
  }
];

// ============================================================================
// ANNOUNCEMENTS - Recent System Communications
// ============================================================================
export const announcements = [
  {
    id: 1,
    type: 'news',
    icon: 'fa-newspaper',
    title: 'Government Subsidy Announcement',
    description: 'New subsidy programs available for farmers. Apply before Feb 15.',
    date: 'Jan 29, 2026, 10:30 AM',
    color: 'blue',
    author: 'Admin',
    readCount: 127
  },
  {
    id: 2,
    type: 'maintenance',
    icon: 'fa-wrench',
    title: 'System Maintenance Notice',
    description: 'Platform maintenance scheduled for Feb 5, 2-4 AM. Service will be unavailable.',
    date: 'Jan 28, 2026, 3:15 PM',
    color: 'yellow',
    author: 'Admin',
    readCount: 89
  },
  {
    id: 3,
    type: 'program',
    icon: 'fa-seedling',
    title: 'New Organic Farming Program Launch',
    description: 'Introducing new certification program for organic farmers. Limited slots available.',
    date: 'Jan 27, 2026, 9:00 AM',
    color: 'green',
    author: 'Admin',
    readCount: 156
  }
];

// ============================================================================
// ADMIN USERS - User Management
// ============================================================================
export const adminUsers = [
  {
    id: 1,
    name: 'Juan Dela Cruz',
    email: 'admin@mannalonapp.com',
    role: 'Super Admin',
    permissions: 'Full Access',
    status: 'Active',
    lastLogin: 'Jan 29, 2026, 10:45 AM',
    joinDate: 'Jan 1, 2026',
    avatar: 'J'
  },
  {
    id: 2,
    name: 'Maria Santos',
    email: 'editor@mannalonapp.com',
    role: 'Editor',
    permissions: 'Content Management',
    status: 'Active',
    lastLogin: 'Jan 28, 2026, 3:20 PM',
    joinDate: 'Jan 5, 2026',
    avatar: 'M'
  },
  {
    id: 3,
    name: 'Carlos Rodriguez',
    email: 'moderator@mannalonapp.com',
    role: 'Moderator',
    permissions: 'Moderation & Reporting',
    status: 'Active',
    lastLogin: 'Jan 27, 2026, 2:10 PM',
    joinDate: 'Jan 10, 2026',
    avatar: 'C'
  },
  {
    id: 4,
    name: 'Anna Garcia',
    email: 'viewer@mannalonapp.com',
    role: 'Viewer',
    permissions: 'Read-Only Access',
    status: 'Inactive',
    lastLogin: 'Dec 15, 2025, 1:45 PM',
    joinDate: 'Dec 1, 2025',
    avatar: 'A'
  }
];

// ============================================================================
// CROP CATEGORIES - Agricultural Data
// ============================================================================
export const cropCategories = [
  { name: 'Rice', icon: '🍚', count: 98, color: 'yellow' },
  { name: 'Corn', icon: '🌽', count: 67, color: 'yellow' },
  { name: 'Vegetables', icon: '🥬', count: 54, color: 'green' },
  { name: 'Fruits', icon: '🍊', count: 26, color: 'orange' }
];

// ============================================================================
// REGIONAL DISTRIBUTION - Geography Data
// ============================================================================
export const regionalDistribution = [
  { region: 'Kandy', farmers: 62, percentage: 25 },
  { region: 'Colombo', farmers: 85, percentage: 35 },
  { region: 'Galle', farmers: 58, percentage: 24 },
  { region: 'Matara', farmers: 40, percentage: 16 }
];

// ============================================================================
// ENGAGEMENT STATISTICS - User Activities
// ============================================================================
export const engagementStats = [
  {
    activity: 'Reading Guides',
    count: 156,
    unit: 'farmers',
    icon: 'fa-book-open',
    color: 'blue',
    trend: '+12%'
  },
  {
    activity: 'Checking Weather',
    count: 198,
    unit: 'daily active users',
    icon: 'fa-cloud-sun',
    color: 'emerald',
    trend: '+8%'
  },
  {
    activity: 'Viewing Prices',
    count: 142,
    unit: 'farmers',
    icon: 'fa-chart-bar',
    color: 'orange',
    trend: '+15%'
  },
  {
    activity: 'App Sessions',
    count: 1247,
    unit: 'total',
    icon: 'fa-laptop',
    color: 'purple',
    trend: '+22%'
  }
];

// ============================================================================
// WEATHER DATA - Current Conditions
// ============================================================================
export const weatherData = [
  {
    location: 'Kandy',
    temperature: 28,
    condition: 'Partly Cloudy',
    humidity: 72,
    windSpeed: 12,
    lastUpdated: '2 hours ago',
    emoji: '⛅'
  },
  {
    location: 'Colombo',
    temperature: 32,
    condition: 'Sunny',
    humidity: 65,
    windSpeed: 8,
    lastUpdated: '1 hour ago',
    emoji: '☀️'
  },
  {
    location: 'Galle',
    temperature: 25,
    condition: 'Heavy Rain',
    humidity: 85,
    windSpeed: 20,
    lastUpdated: 'Just now',
    emoji: '🌧️'
  }
];

// ============================================================================
// SYSTEM LOGS - Audit Trail
// ============================================================================
export const systemLogs = [
  {
    timestamp: 'Jan 29, 2026 - 10:45 AM',
    event: 'Admin Login',
    user: 'Juan Dela Cruz',
    action: 'Successful authentication from 192.168.1.100',
    type: 'info'
  },
  {
    timestamp: 'Jan 29, 2026 - 10:30 AM',
    event: 'Farmer Registered',
    user: 'System',
    action: 'New farmer account created: Juan Dela Cruz (ID: 245)',
    type: 'success'
  },
  {
    timestamp: 'Jan 29, 2026 - 09:15 AM',
    event: 'Dashboard Access',
    user: 'Maria Santos',
    action: 'Admin dashboard accessed',
    type: 'info'
  },
  {
    timestamp: 'Jan 28, 2026 - 03:20 PM',
    event: 'Price Update',
    user: 'System',
    action: 'Market prices synchronized: 5 commodities updated',
    type: 'success'
  },
  {
    timestamp: 'Jan 28, 2026 - 02:00 PM',
    event: 'Backup Complete',
    user: 'System',
    action: 'Daily backup completed successfully - 2.8 GB backed up',
    type: 'success'
  },
  {
    timestamp: 'Jan 28, 2026 - 01:45 PM',
    event: 'Weather Sync',
    user: 'System',
    action: 'Weather data synchronized from PAGASA API',
    type: 'success'
  },
  {
    timestamp: 'Jan 28, 2026 - 01:00 PM',
    event: 'Announcement Posted',
    user: 'Admin',
    action: 'New announcement: Government Subsidy Program',
    type: 'info'
  },
  {
    timestamp: 'Jan 27, 2026 - 09:30 AM',
    event: 'Farmer Verification',
    user: 'Carlos Rodriguez',
    action: 'Farmer profile verified: Maria Santos (ID: 242)',
    type: 'success'
  },
  {
    timestamp: 'Jan 27, 2026 - 08:00 AM',
    event: 'Guide Published',
    user: 'Maria Santos',
    action: 'New farming guide published: Organic Rice Farming',
    type: 'success'
  },
  {
    timestamp: 'Jan 26, 2026 - 11:45 PM',
    event: 'Database Backup',
    user: 'System',
    action: 'Automated backup initiated and completed',
    type: 'success'
  }
];

// ============================================================================
// KEY METRICS - Dashboard KPIs
// ============================================================================
export const keyMetrics = [
  {
    label: 'Active Users',
    value: 87,
    trend: '+5% this week',
    icon: 'fa-users',
    color: 'emerald',
    comparison: '82 last week'
  },
  {
    label: 'Avg. Crops/Farmer',
    value: 3.2,
    trend: '245 total farmers',
    icon: 'fa-leaf',
    color: 'blue',
    comparison: '734 total crops'
  },
  {
    label: 'Livestock/Farmer',
    value: 2.8,
    trend: '680 livestock total',
    icon: 'fa-cow',
    color: 'orange',
    comparison: 'Avg per farmer'
  },
  {
    label: 'System Health',
    value: '98%',
    trend: 'All systems normal',
    icon: 'fa-heartbeat',
    color: 'purple',
    comparison: 'Uptime this month'
  }
];

// ============================================================================
// ALERTS - System Alerts & Notifications
// ============================================================================
export const systemAlerts = [
  {
    type: 'success',
    icon: 'fa-envelope',
    title: 'Mail Service: Operational',
    message: 'Email notifications are working normally. Last sent 2 min ago.',
    detail: null,
    timestamp: 'Just now'
  },
  {
    type: 'warning',
    icon: 'fa-database',
    title: 'Storage: 75% Used',
    message: 'Storage capacity is at 75%. Consider cleanup or upgrade within 30 days.',
    detail: '3.75 GB / 5 GB',
    timestamp: '1 hour ago'
  }
];

// ============================================================================
// EXPORT ALL DATA AS SINGLE OBJECT
// ============================================================================
export const mockData = {
  summaryStats,
  recentFarmers,
  marketPrices,
  systemHealth,
  activityMetrics,
  announcements,
  adminUsers,
  cropCategories,
  regionalDistribution,
  engagementStats,
  weatherData,
  systemLogs,
  keyMetrics,
  systemAlerts,
  generatedAt: new Date().toISOString(),
  version: '1.0.0'
};

// Default export
export default mockData;
