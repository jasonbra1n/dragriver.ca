# 🎨 Drag River Creative - Style Guide

This document outlines the visual design system for the Drag River ecosystem.

## 🌈 Color Palette

### Core Colors
| Name | Hex | Usage |
|------|-----|-------|
| **Deep Space** | `#0f0f23` | Main background (darkest) |
| **Midnight** | `#1a1a2e` | Background mid-tone |
| **Abyss** | `#16213e` | Background accent |
| **White** | `#ffffff` | Primary text |
| **Cyan** | `#00d4ff` | Primary accent, highlights, hover states |
| **Royal Blue** | `#5b86e5` | Secondary accent, gradients |

### Gradients
- **Primary Brand**: `linear-gradient(135deg, #00d4ff, #5b86e5)`
- **Background**: `linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%)`
- **Text Gradient**: `linear-gradient(135deg, #ffffff, #00d4ff)`

---

## 🔤 Typography

**Font Family**: `Inter`, sans-serif

| Style | Weight | Size (Desktop) | Usage |
|-------|--------|----------------|-------|
| **H1** | 700 (Bold) | `clamp(3rem, 8vw, 6rem)` | Hero headings |
| **H2** | 700 (Bold) | `2.5rem` | Section titles |
| **H3** | 600 (Semi-Bold) | `1.5rem` | Card titles |
| **Body** | 400 (Regular) | `1rem` | Standard text |
| **Label** | 500 (Medium) | `0.9rem` | Form labels, nav links |

---

## 🧩 Components

### Buttons
Rounded pills with the primary gradient.
```css
.cta-button {
    background: linear-gradient(135deg, #00d4ff, #5b86e5);
    border-radius: 50px;
    color: white;
}
```

### Cards
Glassmorphism effect with a top gradient border on hover.
```css
.card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
}
```

### Navigation
- **Desktop**: Horizontal flex row.
- **Mobile**: Vertical stack, absolute positioning, dark backdrop.

---

## 📐 Layout
- **Max Width**: `1200px` (Standard), `1400px` (Dashboard)
- **Spacing**: `2rem` grid gaps, `1rem` padding standard.