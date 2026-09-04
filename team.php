<?php
$pageTitle = 'Research Team';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';

// Team members data configuration matching the design
$teamMembers = [
    [
        'name' => 'Maria Zubair',
        'badge' => 'GIS EXPERT, TEAM LEAD',
        'badge_class' => 'badge-green',
        'border_color' => '#22c55e',
        'bio' => 'Leading the geospatial research initiatives and team direction.',
        'since' => 'Since 2020',
        'photo' => '/assets/images/team/maria_zubair.jpg'
    ],
    [
        'name' => 'Dr. S Zaheer Hussain',
        'badge' => 'GIS EXPERT',
        'badge_class' => 'badge-blue',
        'border_color' => '#3b82f6',
        'bio' => 'Expert in geospatial data analysis and spatial methodologies.',
        'since' => 'Since 2018',
        'photo' => '/assets/images/team/zaheer_hussain.jpg'
    ],
    [
        'name' => 'Dr. Syed Muhammad Irteza',
        'badge' => 'GIS SPECIALIST',
        'badge_class' => 'badge-purple',
        'border_color' => '#a855f7',
        'bio' => 'Specialized in GIS applications and spatial data management.',
        'since' => 'Since 2019',
        'photo' => '/assets/images/team/syed_irteza.jpg'
    ],
    [
        'name' => 'Ansa Shafi',
        'badge' => 'GIS SPECIALIST',
        'badge_class' => 'badge-peach',
        'border_color' => '#f97316',
        'bio' => 'Focused on geospatial analysis and spatial intelligence applications.',
        'since' => 'Since 2021',
        'photo' => '/assets/images/team/ansa_shafi.jpg'
    ],
    [
        'name' => 'Reeha Kashif',
        'badge' => 'DEVELOPER/SOFTWARE ENGINEER',
        'badge_class' => 'badge-mint',
        'border_color' => '#10b981',
        'bio' => 'Developing software solutions and technical implementations for geospatial platforms.',
        'since' => 'Since 2022',
        'photo' => '/assets/images/team/reeha_kashif.jpg'
    ]
];

// Moments Together photos
$teamMoments = [
    [
        'url' => '/team%20images/team%20image%202.jpeg',
        'alt' => 'GDSG Team Collaboration Meeting',
        'caption' => 'Strategic planning and research review session.'
    ],
    [
        'url' => '/team%20images/team%20image%204.jpeg',
        'alt' => 'GDSG Team Discussion',
        'caption' => 'Cross-functional geospatial project evaluation.'
    ],
    [
        'url' => '/team%20images/team%20image%205.jpeg',
        'alt' => 'GDSG Team Conference',
        'caption' => 'Team workshop and operational alignment.'
    ]
];

// Internship Batches (2026 Active Cohorts & 2027 Upcoming Slots)
$internshipBatches = [
    // --- 2026 COHORTS (CURRENT INTERNS) ---
    [
        'year' => '2026',
        'title' => 'Interns – Spring 2026',
        'date' => 'July to September 2026',
        'image' => '/team%20with%20interns/team%20with%20intern%201.jpeg',
        'caption' => 'July to September 2026 Internship Cohort presentation.'
    ],
    [
        'year' => '2026',
        'title' => 'Interns – Fall 2026',
        'date' => 'July to September 2026',
        'image' => '/team%20with%20interns/team%20with%20interns%202.jpeg',
        'caption' => 'July to September 2026 Internship Cohort hands-on session.'
    ],
    [
        'year' => '2026',
        'title' => 'Interns – Summer 2026',
        'date' => 'July to September 2026',
        'image' => '/team%20with%20interns/team%20with%20interns%203.jpeg',
        'caption' => 'July to September 2026 GeoAI & remote sensing batch.'
    ],
    [
        'year' => '2026',
        'title' => 'Interns – Batch 2026',
        'date' => 'July to September 2026',
        'image' => '/team%20with%20interns/interns%201.jpeg',
        'caption' => 'July to September 2026 project showcase.'
    ],
    [
        'year' => '2026',
        'title' => 'Interns – Batch 2026',
        'date' => 'July to September 2026',
        'image' => '/team%20with%20interns/interns%202.jpeg',
        'caption' => 'July to September 2026 graduation and certificate distribution.'
    ],

    // --- 2027 COHORTS (RESERVED PLACEHOLDER SLOTS) ---
    [
        'year' => '2027',
        'title' => 'Interns – Spring 2027',
        'date' => 'July to September 2027',
        'image' => '',
        'caption' => 'Spring 2027 Internship Cohort – Photo slot reserved.'
    ],
    [
        'year' => '2027',
        'title' => 'Interns – Summer 2027',
        'date' => 'July to September 2027',
        'image' => '',
        'caption' => 'Summer 2027 Internship Cohort – Photo slot reserved.'
    ],
    [
        'year' => '2027',
        'title' => 'Interns – Fall 2027',
        'date' => 'July to September 2027',
        'image' => '',
        'caption' => 'Fall 2027 Internship Cohort – Photo slot reserved.'
    ],
    [
        'year' => '2027',
        'title' => 'Interns – Batch 2027',
        'date' => 'July to September 2027',
        'image' => '',
        'caption' => 'Batch 2027 – Photo slot reserved.'
    ],
    [
        'year' => '2027',
        'title' => 'Interns – Batch 2027',
        'date' => 'July to September 2027',
        'image' => '',
        'caption' => 'Batch 2027 – Photo slot reserved.'
    ]
];
?>

<style>
/* ========================================================
   GDSG RESEARCH TEAM PAGE STYLING (EXACT DESIGN MATCH)
   ======================================================== */

.team-page-wrapper {
    background-color: #f8fafc;
    color: #1e293b;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding-bottom: 80px;
}

/* ---------------- HERO SECTION ---------------- */
.team-hero-banner {
    position: relative;
    background: linear-gradient(135deg, #f0f8fd 0%, #f4fbf8 50%, #edf6fc 100%);
    border-bottom: 1px solid #e2e8f0;
    padding: 65px 0 55px;
    overflow: hidden;
}

.team-hero-contour {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 58%;
    max-width: 860px;
    background-image: url('/assets/images/team/team_hero_globe_clean.png');
    background-size: cover;
    background-position: center right;
    background-repeat: no-repeat;
    opacity: 0.95;
    pointer-events: none;
}

@media (max-width: 768px) {
    .team-hero-contour {
        opacity: 0.25;
        width: 100%;
    }
}

.team-hero-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
}

.section-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #15803d;
    margin-bottom: 14px;
}

.section-eyebrow .eyebrow-line {
    display: inline-block;
    width: 32px;
    height: 2px;
    background: #16a34a;
    border-radius: 2px;
}

.section-eyebrow .eyebrow-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #dcfce7;
    color: #16a34a;
}

.section-eyebrow .eyebrow-icon .material-symbols-outlined {
    font-size: 16px;
}

.team-hero-heading {
    font-size: clamp(2.4rem, 4.5vw, 3.6rem);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.025em;
    color: #0f172a;
    margin-bottom: 16px;
}

.team-hero-heading .blue-accent {
    color: #2563eb;
}

.team-hero-lead {
    font-size: 1.12rem;
    line-height: 1.6;
    color: #475569;
    font-weight: 400;
    margin-bottom: 0;
}

/* ---------------- SECTION COMMON ---------------- */
.team-page-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 20px;
}

.team-section-block {
    margin-top: 48px;
}

/* ---------------- OUR TEAM GRID ---------------- */
.team-cards-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 18px;
    margin-top: 20px;
}

@media (max-width: 1200px) {
    .team-cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .team-cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 520px) {
    .team-cards-grid {
        grid-template-columns: 1fr;
    }
}

.team-member-card-new {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 26px 16px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow: 0 4px 18px -2px rgba(15, 23, 42, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    height: 100%;
}

.team-member-card-new:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px -4px rgba(15, 23, 42, 0.08);
    border-color: #cbd5e1;
}

.member-avatar-wrapper {
    width: 92px;
    height: 92px;
    border-radius: 50%;
    padding: 3px;
    background: #ffffff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-bottom: 14px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.member-avatar-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

.member-name {
    font-size: 1.02rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.25;
}

.member-role-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 9999px;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin-bottom: 12px;
    line-height: 1.2;
}

.badge-green {
    background-color: #dcfce7;
    color: #15803d;
}

.badge-blue {
    background-color: #dbeafe;
    color: #1d4ed8;
}

.badge-purple {
    background-color: #f3e8ff;
    color: #7e22ce;
}

.badge-peach {
    background-color: #ffedd5;
    color: #c2410c;
}

.badge-mint {
    background-color: #d1fae5;
    color: #047857;
}

.member-bio-text {
    font-size: 0.81rem;
    color: #475569;
    line-height: 1.45;
    margin-bottom: 16px;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.member-since-footer {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 0.76rem;
    color: #64748b;
    font-weight: 500;
    border-top: 1px solid #f1f5f9;
    padding-top: 12px;
    width: 100%;
}

.member-since-footer .material-symbols-outlined {
    font-size: 15px;
    color: #64748b;
}

/* ---------------- SECTION 2: TEAM GALLERY (MOMENTS TOGETHER) ---------------- */
.team-gallery-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 28px;
    align-items: center;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
}

@media (max-width: 992px) {
    .team-gallery-layout {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 24px;
    }
}

.moments-heading {
    font-size: 1.7rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 10px;
    line-height: 1.2;
}

.moments-desc {
    font-size: 0.88rem;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 0;
}

.moments-photos-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

@media (max-width: 768px) {
    .moments-photos-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .moments-photos-grid {
        grid-template-columns: 1fr;
    }
}

.moment-photo-item {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    background: #f1f5f9;
    aspect-ratio: 16 / 11;
    border: 1px solid #e2e8f0;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.moment-photo-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.1);
}

.moment-photo-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}

.moment-photo-item:hover img {
    transform: scale(1.04);
}

/* ---------------- SECTION 3: INTERNS BANNER ---------------- */
.interns-spotlight-card {
    background: #eef6ff;
    border: 1px solid #d0e3fc;
    border-radius: 20px;
    padding: 36px 44px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 20px -2px rgba(37, 99, 235, 0.04);
}

@media (max-width: 992px) {
    .interns-spotlight-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 28px;
    }
}

.spotlight-left-group {
    display: flex;
    align-items: flex-start;
    gap: 22px;
    max-width: 760px;
}

@media (max-width: 600px) {
    .spotlight-left-group {
        flex-direction: column;
        gap: 16px;
    }
}

.spotlight-icon-bubble {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: #dbeafe;
    color: #1d4ed8;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.12);
}

.spotlight-icon-bubble .material-symbols-outlined {
    font-size: 34px;
}

.spotlight-tag {
    font-size: 0.74rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #2563eb;
    margin-bottom: 6px;
}

.spotlight-title {
    font-size: 1.65rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 12px;
    letter-spacing: -0.01em;
}

.spotlight-text {
    font-size: 0.86rem;
    color: #475569;
    line-height: 1.65;
    margin-bottom: 0;
}

.spotlight-illustration-wrap {
    flex-shrink: 0;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.spotlight-illustration {
    max-height: 180px;
    width: auto;
    object-fit: contain;
    display: block;
}

/* ---------------- SECTION 4: INTERNSHIP GALLERY ---------------- */
.intern-gallery-header-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 18px;
    gap: 16px;
    flex-wrap: wrap;
}

.intern-gallery-title {
    font-size: 1.7rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 0;
}

.intern-glimpses-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
    transition: color 0.2s ease, transform 0.2s ease;
}

.intern-glimpses-link:hover {
    color: #1d4ed8;
    transform: translateX(3px);
}

.intern-glimpses-link .material-symbols-outlined {
    font-size: 18px;
}

/* Year Filter Tabs */
.year-filter-tabs {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 22px;
    overflow-x: auto;
    padding-bottom: 4px;
}

.year-tab-btn {
    border: none;
    background: #f1f5f9;
    color: #475569;
    font-size: 0.84rem;
    font-weight: 600;
    padding: 7px 18px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.year-tab-btn:hover {
    background: #e2e8f0;
    color: #0f172a;
}

.year-tab-btn.active {
    background: #2563eb;
    color: #ffffff;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
}

/* Intern 5-Card Row */
.intern-cards-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
}

@media (max-width: 1200px) {
    .intern-cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .intern-cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 520px) {
    .intern-cards-grid {
        grid-template-columns: 1fr;
    }
}

.intern-batch-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease, opacity 0.25s ease;
    cursor: pointer;
}

.intern-batch-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px -4px rgba(15, 23, 42, 0.08);
    border-color: #cbd5e1;
}

.intern-batch-card.is-placeholder {
    border: 1px dashed #cbd5e1;
    background: #fafafa;
}

.intern-batch-card.is-placeholder:hover {
    border-color: #3b82f6;
    background: #ffffff;
}

.intern-batch-card[data-year="2027"] {
    display: none;
}

.intern-card-thumb {
    width: 100%;
    height: 140px;
    overflow: hidden;
    background: #f1f5f9;
}

.intern-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}

.intern-batch-card:hover .intern-card-thumb img {
    transform: scale(1.05);
}

.intern-card-thumb.placeholder-thumb {
    background: #f8fafc;
    border-bottom: 1px dashed #e2e8f0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    color: #94a3b8;
    transition: all 0.25s ease;
}

.intern-batch-card:hover .intern-card-thumb.placeholder-thumb {
    background: #eff6ff;
    color: #2563eb;
}

.placeholder-thumb .material-symbols-outlined {
    font-size: 36px;
    transition: transform 0.25s ease;
}

.intern-batch-card:hover .placeholder-thumb .material-symbols-outlined {
    transform: scale(1.1);
}

.placeholder-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.placeholder-badge {
    display: inline-block;
    padding: 2px 8px;
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
    border-radius: 9999px;
    font-size: 0.68rem;
    font-weight: 700;
    margin-top: 5px;
    letter-spacing: 0.3px;
}

.intern-card-body {
    padding: 14px 12px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.intern-card-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
    line-height: 1.3;
}

.intern-card-date {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.76rem;
    color: #64748b;
    font-weight: 500;
    margin-bottom: 0;
}

.intern-card-date .material-symbols-outlined {
    font-size: 15px;
    color: #64748b;
}

.view-all-batches-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
    margin-top: 24px;
    transition: color 0.2s ease, transform 0.2s ease;
}

.view-all-batches-link:hover {
    color: #1d4ed8;
    transform: translateX(4px);
}

.view-all-batches-link .material-symbols-outlined {
    font-size: 18px;
}

/* ---------------- LIGHTBOX MODAL ---------------- */
.team-lightbox-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(8px);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-lightbox-overlay.active {
    display: flex;
    opacity: 1;
}

.team-lightbox-box {
    position: relative;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    display: flex;
    flex-direction: column;
    animation: lightboxPop 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes lightboxPop {
    from {
        transform: scale(0.95);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.team-lightbox-img-wrap {
    width: 100%;
    max-height: 75vh;
    background: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.team-lightbox-img-wrap img {
    max-width: 100%;
    max-height: 75vh;
    object-fit: contain;
    display: block;
}

.team-lightbox-footer {
    padding: 14px 20px;
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.team-lightbox-caption {
    font-size: 0.9rem;
    font-weight: 600;
    color: #0f172a;
    margin: 0;
}

.team-lightbox-close {
    position: absolute;
    top: 14px;
    right: 14px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(15, 23, 42, 0.7);
    color: #ffffff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.2s ease;
    z-index: 10;
}

.team-lightbox-close:hover {
    background: rgba(15, 23, 42, 0.95);
    transform: scale(1.08);
}

.team-lightbox-close .material-symbols-outlined {
    font-size: 22px;
}
</style>

<div class="team-page-wrapper">
    <!-- 1. HERO SECTION -->
    <section class="team-hero-banner">
        <div class="team-hero-contour" aria-hidden="true"></div>
        <div class="team-page-container">
            <div class="team-hero-content">
                <div class="section-eyebrow">
                    <span>RESEARCH TEAM</span>
                    <span class="eyebrow-line"></span>
                </div>
                <h1 class="team-hero-heading">Research <span class="blue-accent">Team</span></h1>
                <p class="team-hero-lead">A multidisciplinary collective of scientists and engineers pioneering the intersection of AI, GIS, and Earth observation.</p>
            </div>
        </div>
    </section>

    <div class="team-page-container">
        <!-- 2. OUR TEAM SECTION -->
        <section class="team-section-block">
            <div class="section-eyebrow">
                <span class="eyebrow-icon">
                    <span class="material-symbols-outlined">group</span>
                </span>
                <span>OUR TEAM</span>
                <span class="eyebrow-line"></span>
            </div>

            <div class="team-cards-grid">
                <?php foreach ($teamMembers as $m): ?>
                    <div class="team-member-card-new">
                        <div class="member-avatar-wrapper" style="border: 3px solid <?php echo $m['border_color']; ?>;">
                            <img src="<?php echo htmlspecialchars($m['photo']); ?>" 
                                 alt="<?php echo htmlspecialchars($m['name']); ?>" 
                                 class="member-avatar-img" 
                                 loading="lazy">
                        </div>
                        <h3 class="member-name"><?php echo htmlspecialchars($m['name']); ?></h3>
                        <span class="member-role-badge <?php echo htmlspecialchars($m['badge_class']); ?>">
                            <?php echo htmlspecialchars($m['badge']); ?>
                        </span>
                        <p class="member-bio-text"><?php echo htmlspecialchars($m['bio']); ?></p>
                        <div class="member-since-footer">
                            <span class="material-symbols-outlined">calendar_today</span>
                            <span><?php echo htmlspecialchars($m['since']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- 3. TEAM GALLERY: MOMENTS TOGETHER -->
        <section class="team-section-block">
            <div class="team-gallery-layout">
                <div class="moments-meta-col">
                    <div class="section-eyebrow">
                        <span class="eyebrow-icon">
                            <span class="material-symbols-outlined">photo_camera</span>
                        </span>
                        <span>TEAM GALLERY</span>
                        <span class="eyebrow-line"></span>
                    </div>
                    <h2 class="moments-heading">Moments Together</h2>
                    <p class="moments-desc">Snapshots from our team meetings, collaborations, and daily work at GDSG.</p>
                </div>
                <div class="moments-photos-grid">
                    <?php foreach ($teamMoments as $img): ?>
                        <div class="moment-photo-item js-lightbox-trigger" 
                             data-img="<?php echo htmlspecialchars($img['url']); ?>"
                             data-caption="<?php echo htmlspecialchars($img['alt']); ?>">
                            <img src="<?php echo htmlspecialchars($img['url']); ?>" 
                                 alt="<?php echo htmlspecialchars($img['alt']); ?>" 
                                 loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- 4. INTERNS BANNER: LEARN. EXPLORE. GROW. -->
        <section class="team-section-block">
            <div class="interns-spotlight-card">
                <div class="spotlight-left-group">
                    <div class="spotlight-icon-bubble">
                        <span class="material-symbols-outlined">school</span>
                    </div>
                    <div class="spotlight-text-content">
                        <div class="spotlight-tag">INTERNS AT GDSG</div>
                        <h2 class="spotlight-title">Learn. Explore. Grow.</h2>
                        <p class="spotlight-text">
                            Our interns bring curiosity, fresh ideas, and a strong willingness to learn to every project.<br>
                            Working with the team gives them practical experience in AI, GIS, remote sensing, and Earth observation.<br>
                            They collaborate with researchers, explore real-world challenges, and turn classroom knowledge into meaningful solutions.<br>
                            This experience helps them grow with confidence while contributing to the future of geospatial innovation.
                        </p>
                    </div>
                </div>
                <div class="spotlight-illustration-wrap">
                    <img src="/assets/images/team/intern_climbing_illustration.png" 
                         alt="GDSG Interns learning and growing" 
                         class="spotlight-illustration">
                </div>
            </div>
        </section>

        <!-- 5. INTERNSHIP GALLERY -->
        <section class="team-section-block">
            <div class="intern-gallery-header-row">
                <div>
                    <div class="section-eyebrow">
                        <span class="eyebrow-icon">
                            <span class="material-symbols-outlined">diversity_3</span>
                        </span>
                        <span>INTERNSHIP GALLERY</span>
                    </div>
                    <h2 class="intern-gallery-title">Our Interns at GDSG</h2>
                </div>
                <a href="#intern-gallery-anchor" class="intern-glimpses-link">
                    <span>Glimpses from our internship journey.</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>

            <!-- Year Filter Tabs (2026 & 2027) -->
            <div class="year-filter-tabs">
                <button type="button" class="year-tab-btn active" data-year="2026">2026</button>
                <button type="button" class="year-tab-btn" data-year="2027">2027</button>
            </div>

            <!-- Internship Cards Grid -->
            <div class="intern-cards-grid" id="intern-gallery-anchor">
                <?php foreach ($internshipBatches as $batch): 
                    $isPlaceholder = empty($batch['image']);
                    $cardClasses = 'intern-batch-card' . (!$isPlaceholder ? ' js-lightbox-trigger' : ' is-placeholder');
                ?>
                    <div class="<?php echo $cardClasses; ?>" 
                         data-year="<?php echo htmlspecialchars($batch['year']); ?>"
                         <?php if (!$isPlaceholder): ?>
                         data-img="<?php echo htmlspecialchars($batch['image']); ?>"
                         data-caption="<?php echo htmlspecialchars($batch['title'] . ' (' . $batch['date'] . ')'); ?>"
                         <?php else: ?>
                         data-placeholder="true"
                         title="2027 Photo Slot (Ready for image upload)"
                         <?php endif; ?>>
                        <?php if (!$isPlaceholder): ?>
                            <div class="intern-card-thumb">
                                <img src="<?php echo htmlspecialchars($batch['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($batch['title']); ?>" 
                                     loading="lazy">
                            </div>
                        <?php else: ?>
                            <div class="intern-card-thumb placeholder-thumb">
                                <span class="material-symbols-outlined">add_photo_alternate</span>
                                <span class="placeholder-label">Add Photo</span>
                            </div>
                        <?php endif; ?>
                        <div class="intern-card-body">
                            <h4 class="intern-card-title"><?php echo htmlspecialchars($batch['title']); ?></h4>
                            <p class="intern-card-date">
                                <span class="material-symbols-outlined">calendar_today</span>
                                <?php echo htmlspecialchars($batch['date']); ?>
                            </p>
                            <?php if ($isPlaceholder): ?>
                                <span class="placeholder-badge">Slot Reserved</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Bottom Link -->
            <div class="text-start">
                <a href="#" class="view-all-batches-link">
                    <span>View all internship galleries</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>
        </section>
    </div>
</div>

<!-- LIGHTBOX MODAL -->
<div id="team-lightbox-modal" class="team-lightbox-overlay" aria-hidden="true">
    <div class="team-lightbox-box">
        <button type="button" class="team-lightbox-close" id="lightbox-close-btn" aria-label="Close modal">
            <span class="material-symbols-outlined">close</span>
        </button>
        <div class="team-lightbox-img-wrap">
            <img id="lightbox-main-img" src="" alt="Full view">
        </div>
        <div class="team-lightbox-footer">
            <p id="lightbox-caption" class="team-lightbox-caption"></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Lightbox modal logic
    const lightboxModal = document.getElementById('team-lightbox-modal');
    const lightboxImg = document.getElementById('lightbox-main-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close-btn');

    function openLightbox(url, caption) {
        lightboxImg.src = url;
        lightboxCaption.textContent = caption || '';
        lightboxModal.classList.add('active');
        lightboxModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightboxModal.classList.remove('active');
        lightboxModal.setAttribute('aria-hidden', 'true');
        lightboxImg.src = '';
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.js-lightbox-trigger').forEach(function (el) {
        el.addEventListener('click', function () {
            const imgUrl = el.getAttribute('data-img');
            const caption = el.getAttribute('data-caption');
            if (imgUrl) {
                openLightbox(imgUrl, caption);
            }
        });
    });

    if (lightboxClose) {
        lightboxClose.addEventListener('click', closeLightbox);
    }

    if (lightboxModal) {
        lightboxModal.addEventListener('click', function (e) {
            if (e.target === lightboxModal) {
                closeLightbox();
            }
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lightboxModal.classList.contains('active')) {
            closeLightbox();
        }
    });

    // Year filter tabs logic (2026 & 2027)
    const yearButtons = document.querySelectorAll('.year-tab-btn');
    const internCards = document.querySelectorAll('.intern-batch-card');

    function applyYearFilter(selectedYear) {
        internCards.forEach(function (card) {
            const cardYear = card.getAttribute('data-year');
            if (cardYear === selectedYear) {
                card.style.display = 'flex';
                // Trigger reflow for smooth animation
                void card.offsetWidth;
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.96)';
                setTimeout(() => {
                    const currentActive = document.querySelector('.year-tab-btn.active');
                    if (currentActive && card.getAttribute('data-year') !== currentActive.getAttribute('data-year')) {
                        card.style.display = 'none';
                    }
                }, 180);
            }
        });
    }

    // Initialize: show 2026, hide 2027
    applyYearFilter('2026');

    yearButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (btn.classList.contains('active')) return;
            yearButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const selectedYear = btn.getAttribute('data-year');
            applyYearFilter(selectedYear);
        });
    });
});
</script>
