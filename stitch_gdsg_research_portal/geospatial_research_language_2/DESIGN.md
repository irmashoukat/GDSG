---
name: Geospatial Research Language
colors:
  surface: '#f9f9fc'
  surface-dim: '#dadadc'
  surface-bright: '#f9f9fc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f3f6'
  surface-container: '#eeeef0'
  surface-container-high: '#e8e8ea'
  surface-container-highest: '#e2e2e5'
  on-surface: '#1a1c1e'
  on-surface-variant: '#444650'
  inverse-surface: '#2f3133'
  inverse-on-surface: '#f0f0f3'
  outline: '#747781'
  outline-variant: '#c4c6d2'
  surface-tint: '#3f5d9c'
  primary: '#21417f'
  on-primary: '#ffffff'
  primary-container: '#3b5998'
  on-primary-container: '#c2d2ff'
  inverse-primary: '#afc6ff'
  secondary: '#046e00'
  on-secondary: '#ffffff'
  secondary-container: '#81fa69'
  on-secondary-container: '#047300'
  tertiary: '#8c001e'
  on-tertiary: '#ffffff'
  tertiary-container: '#b8002b'
  on-tertiary-container: '#ffc4c4'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d9e2ff'
  primary-fixed-dim: '#afc6ff'
  on-primary-fixed: '#001944'
  on-primary-fixed-variant: '#254583'
  secondary-fixed: '#83fd6c'
  secondary-fixed-dim: '#67e052'
  on-secondary-fixed: '#002200'
  on-secondary-fixed-variant: '#025300'
  tertiary-fixed: '#ffdad9'
  tertiary-fixed-dim: '#ffb3b2'
  on-tertiary-fixed: '#410009'
  on-tertiary-fixed-variant: '#920020'
  background: '#f9f9fc'
  on-background: '#1a1c1e'
  surface-variant: '#e2e2e5'
typography:
  headline-xl:
    fontFamily: Hanken Grotesk
    fontSize: 40px
    fontWeight: '800'
    lineHeight: 48px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Hanken Grotesk
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Hanken Grotesk
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  headline-md:
    fontFamily: Hanken Grotesk
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Hanken Grotesk
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Hanken Grotesk
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Hanken Grotesk
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Hanken Grotesk
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  label-sm:
    fontFamily: Hanken Grotesk
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 14px
    letterSpacing: 0.05em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  unit: 4px
  gutter: 24px
  margin-desktop: 64px
  margin-mobile: 16px
  container-max-width: 1440px
---

## Brand & Style

The design system is engineered for the precision and technical rigor required by geospatial data science. It evokes a sense of authoritative research, institutional reliability, and technological sophistication. The aesthetic is **Corporate / Modern** with a focus on data density and clarity, utilizing the vibrant tones of the source logo to highlight critical insights within complex datasets.

The target audience includes researchers, government officials, and data scientists. The UI must feel robust and "engineered," favoring clean alignment, ample negative space to balance heavy data loads, and a structured hierarchy that mirrors the logical nature of cartography and analytics.

## Colors

The palette is derived directly from the institutional logo, ensuring brand coherence across all digital touchpoints. 

- **Primary (Deep Blue):** Used for primary actions, navigation backgrounds, and authoritative headers. It represents the "Geospatial" core of the identity.
- **Secondary (Vibrant Green):** Primarily used for success states, data growth indicators, and map-related highlights.
- **Tertiary (Red):** Reserved for high-alert data points, error states, and critical "stop" actions. 
- **Neutral:** A deep charcoal is used for text and iconography to maintain higher legibility than pure black, while off-whites are used for surface backgrounds to reduce eye strain during long research sessions.

## Typography

This design system exclusively utilizes **Hanken Grotesk** to maintain a sharp, contemporary, and highly legible appearance across technical interfaces. 

Headlines utilize heavier weights (700-800) to create a clear visual anchor, while body text remains at a standard 400 weight for optimal readability in reports and data tables. Labels and captions are set in semi-bold with increased letter spacing to differentiate them from prose, particularly when used in sidebars and map legends.

## Layout & Spacing

The layout follows a **Fluid Grid** model with a 12-column structure for desktop and a 4-column structure for mobile. 

The spacing rhythm is based on a **4px baseline grid**, ensuring all components and text blocks align mathematically. Gutters are kept wide (24px) to separate distinct data modules and visualizations. On desktop, large sidebars are often used to house filters and metadata, while the primary viewport is reserved for maps or intensive data charts.

## Elevation & Depth

Visual hierarchy is established through **Tonal Layers** and **Low-contrast outlines**. 

Rather than relying on heavy shadows which can clutter a data-rich environment, this system uses subtle background shifts (e.g., a slightly darker gray for the sidebar vs. a pure white for the map canvas). When elevation is required for modals or pop-overs, use a very soft, diffused shadow (15% opacity of the neutral color) to create a sense of float without breaking the professional, flat aesthetic.

## Shapes

In alignment with the "ROUND_EIGHT" requirement, all primary UI elements (buttons, input fields, cards) feature a **0.5rem (8px)** corner radius. 

Large containers, such as data cards or map viewports, should scale to `rounded-lg` (16px) or `rounded-xl` (24px) to maintain a soft, approachable professional feel. This curvature softens the technical nature of the content, making the software feel more like a modern tool and less like legacy enterprise software.

## Components

- **Buttons:** Primary buttons use the Deep Blue (#3b5998) with white text. Secondary buttons use an outline of the same blue with a transparent background.
- **Input Fields:** Use 8px rounded corners with a subtle 1px border. Focus states must use the Primary Blue as a 2px outer ring.
- **Chips & Tags:** Use light tints of the Secondary Green or Tertiary Red to categorize data points without overwhelming the user.
- **Cards:** White background with a 1px border in a light neutral gray. Use 16px padding for standard cards and 24px for high-level summary cards.
- **Data Tables:** Use a zebra-striping pattern with very light gray to help the eye track across rows. Headers should be semi-bold Hanken Grotesk in a slightly smaller font size than the body text.
- **Geospatial Markers:** Map pins and markers should strictly follow the Primary, Secondary, and Tertiary color tokens to denote different categories of research data.