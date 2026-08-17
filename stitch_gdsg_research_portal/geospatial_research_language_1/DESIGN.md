---
name: Geospatial Research Language
colors:
  surface: '#f7f9fb'
  surface-dim: '#d8dadc'
  surface-bright: '#f7f9fb'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f4f6'
  surface-container: '#eceef0'
  surface-container-high: '#e6e8ea'
  surface-container-highest: '#e0e3e5'
  on-surface: '#191c1e'
  on-surface-variant: '#404943'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eff1f3'
  outline: '#717973'
  outline-variant: '#c0c9c1'
  surface-tint: '#356850'
  primary: '#002819'
  on-primary: '#ffffff'
  primary-container: '#06402b'
  on-primary-container: '#77ac90'
  inverse-primary: '#9cd2b5'
  secondary: '#b32821'
  on-secondary: '#ffffff'
  secondary-container: '#fc5d4f'
  on-secondary-container: '#610003'
  tertiary: '#132337'
  on-tertiary: '#ffffff'
  tertiary-container: '#29394d'
  on-tertiary-container: '#92a2bb'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#b8efd0'
  primary-fixed-dim: '#9cd2b5'
  on-primary-fixed: '#002114'
  on-primary-fixed-variant: '#1b503a'
  secondary-fixed: '#ffdad5'
  secondary-fixed-dim: '#ffb4aa'
  on-secondary-fixed: '#410001'
  on-secondary-fixed-variant: '#910b0b'
  tertiary-fixed: '#d3e4fe'
  tertiary-fixed-dim: '#b7c8e1'
  on-tertiary-fixed: '#0b1c30'
  on-tertiary-fixed-variant: '#38485d'
  background: '#f7f9fb'
  on-background: '#191c1e'
  surface-variant: '#e0e3e5'
typography:
  display-lg:
    fontFamily: Hanken Grotesk
    fontSize: 64px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Hanken Grotesk
    fontSize: 40px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Hanken Grotesk
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Hanken Grotesk
    fontSize: 24px
    fontWeight: '500'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  label-mono:
    fontFamily: JetBrains Mono
    fontSize: 13px
    fontWeight: '500'
    lineHeight: '1.0'
    letterSpacing: 0.05em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 48px
  xl: 80px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
---

## Brand & Style

The design system is engineered for the **Geospatial Data Science Group (GDSG)**, projecting a personality of **scientific rigor, technological sophistication, and elite academic heritage**. It draws from the precision of developer tools (Linear/Vercel) and the refined editorial clarity of high-end research institutions (DeepMind).

The visual style is **Modern-Minimalist with Glassmorphic accents**. It prioritizes content through expansive whitespace and a structured grid, while using subtle environmental textures—such as topographic overlays and coordinate grids—to ground the UI in geospatial science. The aesthetic should feel "High-Tech Academic": clean, authoritative, yet approachable for global collaboration.

## Colors

The palette is anchored by **Deep Forest Green**, representing the intersection of nature and data. **Rich Academic Red** serves as a surgical accent for critical information, active research states, and institutional branding markers.

### Tonal Application
- **Primary (Deep Forest Green):** Used for navigation headers, primary buttons, and heavy branding moments.
- **Secondary (Academic Red):** Reserved for notifications, "Live" data indicators, and high-impact badges.
- **Backgrounds:** A tiered system of `White (#FFFFFF)`, `Soft Gray (#F8FAFC)`, and `Slate (#0F172A)` for dark mode.
- **Data Visualization:** Use a curated sub-palette of greens, teals, and earth tones to ensure geospatial maps remain legible and thematic.

*Dark Mode Support:* Invert the neutral scale while maintaining the primary green's saturation to ensure the "Laboratory" feel persists in low-light environments.

## Typography

The typographic hierarchy balances **Hanken Grotesk** for modern, authoritative headlines with **Inter** for high-readability body text. To emphasize the "Data Science" aspect, **JetBrains Mono** is introduced for metadata, coordinates, and technical labels.

- **Editorial Focus:** Large display sizes should use tight letter spacing and heavy weights to create a "Research Journal" cover feel.
- **Technical Accents:** Use the monospaced font for small labels (e.g., DOI numbers, timestamps, and GPS coordinates) to reinforce the scientific context.

## Layout & Spacing

This design system utilizes an **8px linear scale** to ensure mathematical precision across all components.

- **Grid System:** A 12-column fluid grid for desktop with wide margins (64px) to create an editorial, "high-end" feel.
- **Content Blocks:** Use "L-spacing" (80px+) between major sections to allow the eye to rest, mimicking the layout of a modern scientific paper.
- **Mobile Adaptation:** Columns collapse to 4; margins reduce to 16px. Containers should maintain their high corner radius even on smaller screens to preserve the brand identity.

## Elevation & Depth

Depth is achieved through **Tonal Layering** and **Glassmorphism**, rather than traditional heavy shadows.

- **Surfaces:** Use high-diffusion, low-opacity shadows (e.g., `blur: 40px, opacity: 4%`) to give the impression of cards floating on a precise plane.
- **Glassmorphism:** Navigation bars and modal overlays must use a backdrop-blur (20px) with a semi-transparent white (or slate) fill. This creates a "Lens" effect, appropriate for a geospatial lab.
- **Interactive States:** Elements should lift slightly on hover through subtle shadow intensification and a 1px inner border light-hit.

## Shapes

The shape language is characterized by **generous, oversized radii**, which softens the technical nature of the data.

- **Primary Containers:** 16px radius for standard cards.
- **Feature/Hero Elements:** 24px radius (`rounded-xl`) for large imagery and interactive maps.
- **Buttons:** Fully rounded (pill-shaped) for primary actions to contrast against the structured grid.
- **Decorative:** Incorporate subtle "Topographic" background patterns—thin, light-gray vector lines that follow organic curves—to break the rigidity of the grid.

## Components

### Research Cards
Cards should feature a 1px neutral-200 border, no heavy shadow, and use the `label-mono` type for publication dates. Use a "Hover Reveal" state where the secondary red accent appears as a small indicator line on the left.

### Publication Catalogue
A list-based component with high vertical padding. Metadata (Authors, Journal, Date) should be formatted in `JetBrains Mono` at a small scale to differentiate from the editorial title.

### Buttons & Inputs
- **Primary:** Deep Forest Green with white text. Pill-shaped.
- **Secondary:** Transparent with a 1px border.
- **Inputs:** Minimalist with only a bottom border or a very soft background fill. Focus states should use a 2px Deep Forest Green outline.

### The "Coordinate" Background
A global background element consisting of a subtle 80px dot-grid or light-gray coordinate lines (lat/long style) that remains fixed during scroll, reinforcing the geospatial theme.

### Team Profiles
Circular avatars (or high-radius squares) paired with a "Specialization" badge in the secondary red accent.