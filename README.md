# project-fooz
WordPress child theme based on Twenty Twenty-Five with custom styling and a custom Gutenberg FAQ block.

## Table of Contents

- [Requirements](#requirements)
- [Install](#install)
- [Development](#development)

---

## Requirements

- Node.js (LTS)
- npm
- Composer

---

## Install

1. Run `npm install`
2. Run `npm run build` (compiles SCSS and builds Gutenberg blocks)
3. Run `composer install`

---

## Development
- **SCSS**
    - compile - `npm run css-compile`
    - watch - `npm run css-watch`
- **Gutenberg blocks:**
    - **FAQ:**
        - build - `npm run block:faq:build`
        - watch - `npm run block:faq:start`
    - **FAQ Item:**
        - build - `npm run block:faqItem:build`
        - watch - `npm run block:faqItem:start`
    
---

