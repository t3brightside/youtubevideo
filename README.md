# Youtubevideo
[![Software License](https://img.shields.io/badge/license-GPLv2-brightgreen.svg?style=flat)](LICENSE.txt)
[![Packagist](https://img.shields.io/packagist/v/t3brightside/youtubevideo.svg?style=flat)](https://packagist.org/packages/t3brightside/youtubevideo)
[![Downloads](https://poser.pugx.org/t3brightside/youtubevideo/downloads)](https://packagist.org/packages/t3brightside/youtubevideo)
[![Brightside](https://img.shields.io/badge/by-t3brightside.com-orange.svg?style=flat)](https://t3brightside.com)


**TYPO3 CMS extension for simple and responsive YouTube videos with back end preview, optional cover image and cover text.**

[Demo](https://microtemplate.t3brightside.com)

## System requirements

- TYPO3 8.7 LTS, TYPO3 9.5 LTS to 11.5 only since 1.3.0
- fluid_styled_content
- jQuery (recommended)

## Features

- Regular content element settings (title, access, etc.)
- Parses all kinds of dirty YouTube links, youtu.be included
- Custom cover image
- Cover image title, text and predefined crop ratios
- Video caption
- Video aspect ratio (16:9, 4:3, configurable). Multiple aspect ratios and different video sizes on same page.
- Video start time (min/sec)
- Autoplay (on/off)
- Show info (on/off)
- Show related videos (on/off)
- Fullscreen (on/off)
- Loop (on/off)
- Video and selected options preview in page module
- Customizable HTML & TS template

## Screenshots

- [Editing](Documentation/Screenshots/youtubevideo_edit.jpg)
- [Page Module Preview](Documentation/Screenshots/youtubevideo_page_module.jpg)
- [Front End](Documentation/Screenshots/youtubevideo_front_end.jpg)

## Installation

-  Install from TER (**youtubevideo**) or Composer (**t3brightside/youtubevideo**)
-  Include static template
-  jQuery is needed for the cover image and text to function
-  Disable default JS in constants if no cover image, text or custom play button is needed
-  Change breakpoint JS to 'vanilla' or 'none' if no jQuery present in the system

## Usage

Add as any other content element.

## Admin

TypoScript constants can be edited in template constant editor and are explained there.
PageTS config can be found in Configuration/ folder.

## Sources

- [GitHub](https://github.com/t3brightside/youtubevideo)
- [Packagist](https://packagist.org/packages/t3brightside/youtubevideo)
- [TER](https://extensions.typo3.org/extension/youtubevideo/)

Development and maintenance
---------------------------

[Brightside OÜ – TYPO3 development and hosting specialised web agency](https://t3brightside.com)
