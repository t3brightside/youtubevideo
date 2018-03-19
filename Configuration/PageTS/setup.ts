mod.wizards.newContentElement.wizardItems.common {
   elements {
      youtubevideo_pi1 {
         iconIdentifier = youtubevideo_icon
         title = YouTube Video
         description = YouTube video content element
         tt_content_defValues {
            CType = youtubevideo_pi1
         }
      }
   }
   show := addToList(youtubevideo_pi1)
}
TCEFORM.tt_content.tx_youtubevideo_ratio.addItems {
	0 = Widescreen (16:9)
	1 = Standard (4:3)
}