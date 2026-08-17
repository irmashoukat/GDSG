# Geospatial Data Science Group (GDSG) Research Portal

A comprehensive web-based research portal showcasing the work, projects, publications, and team of the **Geospatial Data Science Group (GDSG)**.

## 🌍 Overview

The GDSG Research Portal is a professional web application designed to showcase geospatial research, climate analytics, remote sensing projects, and Earth observation initiatives. The platform features a dynamic news and events system, research project portfolio, publications repository, and team profiles.

## 📋 Features

### Core Features
- **News & Events Management** - Dynamic news and event listings with detail pages
- **Research Projects** - Browse and explore active and completed research initiatives
- **Publications Database** - Comprehensive publication repository with advanced search
- **Team Management** - Team member profiles with expertise and contact information
- **Gallery** - Visual showcase of research work and campus highlights
- **Contact Forms** - Visitor message management system
- **Admin Dashboard** - Comprehensive content management system

### Technical Features
- **Responsive Design** - Mobile-friendly interface for all devices
- **Database-Driven** - MySQL backend for scalable content management
- **Admin Authentication** - Secure login system for content editors
- **RESTful APIs** - JSON API endpoints for external integrations
- **Image Management** - Automatic thumbnail generation and optimization
- **Full-Text Search** - Search capabilities for publications and content
- **Interactive Maps** - Geospatial visualization features

## 🏗️ Project Structure

```
GDSG/
├── admin/                          # Admin dashboard pages
│   ├── index.php                  # Admin home
│   ├── login.php                  # Admin login
│   ├── dashboard.php              # Main dashboard
│   ├── news.php                   # News management
│   ├── publications.php           # Publications management
│   ├── projects.php               # Projects management
│   ├── team.php                   # Team management
│   └── ...
├── api/                            # API endpoints
│   └── get_research_projects.php  # Research projects API
├── includes/                       # Reusable PHP components
│   ├── header.php                 # Page header
│   ├── footer.php                 # Page footer
│   ├── navbar.php                 # Navigation bar
│   ├── config.php                 # Configuration settings
│   ├── db.php                     # Database connection
│   ├── auth.php                   # Authentication utilities
│   ├── functions.php              # Helper functions
│   ├── components.php             # Reusable UI components
│   └── ...
├── assets/                         # Static assets
│   ├── css/                       # Stylesheets
│   │   ├── main.css              # Main stylesheet
│   │   ├── admin-dashboard.css   # Admin dashboard styles
│   │   └── depth-field.css       # Depth field effects
│   ├── js/                        # JavaScript files
│   ├── images/                    # Image assets
│   ├── fonts/                     # Custom fonts
│   └── icons/                     # Icon files
├── database/                       # Database scripts
│   ├── schema.sql                # Database schema
│   ├── seed.sql                  # Sample data
│   ├── migrations/               # Database migrations
│   └── ...
├── docs/                           # Documentation
│   ├── 1_project_overview.md     # Project overview
│   ├── 2_sitemap.md              # Site structure
│   ├── 3_content_structure.md    # Content organization
│   ├── 4_db_schema.md            # Database documentation
│   └── ...
├── scripts/                        # Utility scripts
│   ├── insert_news_data.php      # Insert sample news
│   ├── run_mysql_migrations.php  # Run migrations
│   └── ...
├── uploads/                        # User uploaded files
├── pages/                          # Additional pages
├── stitch_gdsg_research_portal/    # Design files
└── index.php                       # Homepage

```

## 🗄️ Database Schema

### Main Tables
- **users** - Admin users and editors
- **news** - News articles and announcements
- **research_areas** - Research domains and topics
- **projects** - Research projects
- **project_images** - Project visual media
- **publications** - Research publications and papers
- **team_members** - Team member profiles
- **gallery** - Image gallery
- **events** - Events and seminars
- **contact_messages** - Visitor messages
- **settings** - Site configuration

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (optional, for dependencies)

### Step 1: Clone the Repository
```bash
git clone https://github.com/your-org/gdsg-portal.git
cd GDSG
```

### Step 2: Create Database
```bash
# Create database
mysql -u root -p < database/schema.sql

# (Optional) Seed sample data
mysql -u root -p gdsg < database/seed.sql
```

### Step 3: Configure Environment
Copy `includes/config.php.example` to `includes/config.php` and update:
```php
$config = [
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => 'your_password',
    'db_name' => 'gdsg',
    'base_url' => 'http://localhost/GDSG'
];
```

### Step 4: Set Permissions
```bash
chmod 755 uploads/
chmod 755 assets/images/
```

### Step 5: Access the Site
- **Public Site**: `http://localhost/GDSG`
- **Admin Panel**: `http://localhost/GDSG/admin/login.php`

## 👤 Default Admin Credentials
Username: `admin`
Password: `password123`

⚠️ **IMPORTANT**: Change these credentials immediately after first login!

## 📖 Usage Guide

### Adding News Articles
1. Log in to admin panel (`/admin/`)
2. Navigate to "News"
3. Click "Add New"
4. Fill in title, summary, content, and upload featured image
5. Click "Publish"

### Adding Events
1. Go to Admin → Events
2. Click "Add New Event"
3. Enter event details (date, location, description)
4. Upload event poster/image
5. Publish

### Managing Publications
1. Admin → Publications
2. Upload PDF or add publication metadata
3. Manage authors, journal info, and keywords
4. Publish to listing

### Managing Team
1. Admin → Team
2. Add new member with photo
3. Fill in expertise, position, and bio
4. Assign to projects (optional)

### Managing Projects
1. Admin → Projects
2. Create project with research area
3. Add project images and description
4. Assign team members
5. Track project status (ongoing/completed/planned)

## 🎨 Customization

### Styling
- Main stylesheet: `assets/css/main.css`
- Colors and theme defined in CSS variables
- Admin styles: `assets/css/admin-dashboard.css`

### Branding
- Logo: `assets/images/logo.png`
- Favicon: `assets/images/favicon.ico`
- Site title: Modify `includes/config.php`

### Content
- Homepage banner: Edit `index.php`
- Navigation: Edit `includes/navbar.php`
- Footer: Edit `includes/footer.php`

## 🔐 Security Features

- ✅ SQL Injection prevention (prepared statements)
- ✅ XSS protection (HTML sanitization)
- ✅ CSRF token validation
- ✅ Password hashing (bcrypt)
- ✅ Admin session management
- ✅ Input validation and sanitization

## 📱 Responsive Design

The portal is fully responsive and optimized for:
- 📱 Mobile devices (320px+)
- 📱 Tablets (768px+)
- 💻 Desktops (1024px+)
- 🖥️ Large displays (1440px+)

## 🌐 API Endpoints

### Get Research Projects
```bash
GET /api/get_research_projects.php?limit=10
```

Returns JSON array of research projects.

### Get News Items
```bash
GET /news.php
```

Displays news and events listing.

## 📝 Pages

### Public Pages
- **Home** (`index.php`) - Homepage with highlights
- **About** (`about.php`) - GDSG mission and team
- **Research** (`research.php`) - Research domains
- **Projects** (`project.php`) - Research projects listing
- **Publications** (`publications.php`) - Papers and publications
- **News** (`news.php`) - News and events
- **Team** (`team.php`) - Team member directory
- **Gallery** (`gallery.php`) - Photo gallery
- **Contact** (`contact.php`) - Contact form
- **News Detail** (`news_detail.php?id=X`) - Individual news articles

### Admin Pages
- **Dashboard** (`admin/index.php`) - Analytics and overview
- **News Management** (`admin/news.php`) - CRUD operations
- **Events** (`admin/events.php`) - Event management
- **Projects** (`admin/projects.php`) - Project management
- **Publications** (`admin/publications.php`) - Publication management
- **Team** (`admin/team.php`) - Team member management
- **Messages** (`admin/messages.php`) - Contact form submissions
- **Settings** (`admin/settings.php`) - Site configuration

## 🛠️ Development

### Adding New Features

1. **Database Changes**
   - Create migration file in `database/migrations/`
   - Run migration script

2. **New Pages**
   - Create PHP file in root or `pages/`
   - Include header: `require 'includes/header.php'`
   - Include footer: `include 'includes/footer.php'`

3. **Styling**
   - Add CSS to `assets/css/main.css`
   - Follow existing naming conventions

4. **Admin Features**
   - Create admin page in `admin/` folder
   - Use authentication: `require 'auth.php'`
   - Follow admin dashboard template

## 📊 Recent Changes

- ✅ Enhanced news page with background images
- ✅ Colorful card styling (gradient backgrounds)
- ✅ Centered news cards layout
- ✅ Full-width detail pages
- ✅ Improved image display (object-fit: contain)
- ✅ Added news/event detail data
- ✅ Professional "Read more" buttons with hover effects
- ✅ Enhanced metadata display (badges, dates)

## 🐛 Troubleshooting

### Database Connection Error
- Check `includes/config.php` settings
- Verify MySQL is running
- Confirm database and user exist

### Images Not Loading
- Check `uploads/` folder permissions
- Verify image paths in database
- Clear browser cache

### Admin Login Issues
- Verify user exists in database
- Check password (case-sensitive)
- Clear session cookies

### 404 Errors
- Check `.htaccess` file
- Verify Apache mod_rewrite is enabled
- Check file paths and spelling

## 📞 Support & Contribution

- **Issues**: Report bugs via GitHub Issues
- **Contributions**: Submit pull requests
- **Documentation**: Update docs in `/docs` folder

## 📄 License

This project is proprietary and developed for GDSG. All rights reserved.

## 👥 Team

**Geospatial Data Science Group (GDSG)**
- Research Focus: GIS, GeoAI, Remote Sensing, Climate Analytics
- Website: https://gdsg.edu.pk
- Contact: info@gdsg.edu.pk

---

**Last Updated**: August 17, 2026
**Version**: 1.0.0
**Status**: Active & Maintained
