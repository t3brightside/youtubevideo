# Youtubevideo
[![Software License](https://img.shields.io/badge/license-GPLv2-brightgreen.svg?style=flat)](LICENSE.txt)
[![Packagist](https://img.shields.io/packagist/v/t3brightside/youtubevideo.svg?style=flat)](https://packagist.org/packages/t3brightside/youtubevideo)
[![TYPO3](https://img.shields.io/badge/TYPO3-v12-orange.svg?style=flat)](https://extensions.typo3.org/extension/youtubevideo)
[![TYPO3](https://img.shields.io/badge/TYPO3-v13-orange.svg?style=flat)](https://extensions.typo3.org/extension/youtubevideo)
[![Downloads](https://poser.pugx.org/t3brightside/youtubevideo/downloads)](https://packagist.org/packages/t3brightside/youtubevideo)
[![Brightside](https://img.shields.io/badge/by-t3brightside.com-orange.svg?style=flat)](https://t3brightside.com)


**TYPO3 CMS extension for YouTube video content with custom cover images, gallery layout and backend previews.**

**[Demo](https://microtemplate.t3brightside.com)**

## !!! Important
Version 2.0.0 is not compatible with older versions of the extension. There is no upgrade wizard.

## System requirements

- TYPO3
- fluid_styled_content

## Features
- Load Youtube API on play
- Cover image optimisation
- Gallery layout with column selection
- Turn on/off titles and descriptions
- Regular iframe option that's not GDPR friendly
- Pagination
- Dark mode styling

### Video options available:
- title
- description
- mute
- fullscreen
- related
- start & end time
- aspect ratio (widescreen & standard)
- custom cover image

### GDPR compliance
- No external media or cookies before clicking 'Accept & Play'
- No intrusive GDPR notification before actually clicking on the video
- Accept YouTube privacy policy to current or all videos on the domain

## Installation
- `composer req t3brightside/youtubevideo` or from TYPO3 extension repository [youtubevideo](https://extensions.typo3.org/extension/youtubevideo/)
-  Include static template
-  Alter the TypoScript constants if needed
- Extension Configuration: Back end player (default: enabled)
- Extension Configuration: Pagination features (default: disabled)

## Usage

Add as any other content element.

## Sources

- [GitHub](https://github.com/t3brightside/youtubevideo)
- [Packagist](https://packagist.org/packages/t3brightside/youtubevideo)
- [TER](https://extensions.typo3.org/extension/youtubevideo/)

## Development and maintenance

[Brightside OÜ – TYPO3 development and hosting specialised web agency](https://t3brightside.com)
