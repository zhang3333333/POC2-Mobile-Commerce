<?php
/*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
$idnt = rand(500, 1500);
?>

<div id="map-view-container" class="grid-style2 extend-style5">
	<div class="row-fluid">
		<div class="span6 map-view">
			<?php require_once JPATH_COMPONENT_SITE.'/include/search-map.php' ?>
		</div>
		<div class="span6 companies-view">
			<?php 
			if(isset($this->companies)) {
				foreach($this->companies as $company) { ?>
					<div id="company<?php echo $company->id ?>" class="grid-item-holder span6">
						<div class="grid-item">
							<div class="grid-content">
								<?php if(isset($company->packageFeatures) && in_array(SHOW_COMPANY_LOGO, $company->packageFeatures) || ! $appSettings->enable_packages) { ?>
									<a href="<?php echo JBusinessUtil::getCompanyLink($company)?>">
										<?php if(isset($company->logoLocation) && $company->logoLocation!='') { ?>
											<img title="<?php echo $company->name?>" alt="<?php echo $company->name?>" src="<?php echo JURI::root().PICTURES_PATH.$company->logoLocation ?>">
										<?php }else{ ?>
											<img title="<?php echo $company->name?>" alt="<?php echo $company->name?>" src="<?php echo JURI::root().PICTURES_PATH.'/no_image.jpg' ?>">
										<?php } ?>
									</a>
								<?php } else { ?>
									<a href="<?php echo JBusinessUtil::getCompanyLink($company)?>">
										<img title="<?php echo $company->name?>" alt="<?php echo $company->name?>" src="<?php echo JURI::root().PICTURES_PATH.'/no_image.jpg' ?>">
									</a>
								<?php } ?>
								<div class="info">
									<div class="hover_info">
										<h3><?php echo $company->name?></h3>
										<div class="" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
											<i class="dir-icon-map-marker"></i> <?php echo JBusinessUtil::getAddressText($company) ?>
										</div>
										<?php if(!empty($company->phone)) { ?>
											<div itemprop="telephone">
												<i class="dir-icon-phone"></i> <?php echo $company->phone ?>
											</div>
										<?php } ?>
										<?php if(!empty($company->website)) { ?>
											<div>
												<a class="company-website" itemprop="website" title="<?php echo $company->name?>" target="_blank" onclick="increaseWebsiteClicks(<?php echo $company->id ?>)" href="<?php echo $company->website ?>"><i class="dir-icon-globe"></i> <?php echo $company->website ?></a>
											</div>
										<?php } ?>
										<div class="item-vertical-middle">
											<a href="<?php echo JBusinessUtil::getCompanyLink($company)?>" class="btn-view"><?php echo JText::_("LNG_VIEW")?></a>
											<a href="#" class="btn-view btn-show-marker"><?php echo JText::_("LNG_SHOW_ON_MAP")?></a>
										</div>
									</div> 
								</div>
							</div>
							<div class="grid-item-name">
								<h3><?php echo $company->name ?></h3>
								<?php if($appSettings->enable_ratings){?>
									<span title="<?php echo $company->averageRating ?>" class="rating-review-<?php echo $idnt ?>"></span>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function() {
	jQuery('.rating-review-<?php echo $idnt ?>').raty({
		half:       true,
		size:       24,
		starHalf:   'star-half.png',
		starOff:    'star-off.png',
		starOn:     'star-on.png',
		hintList:	  ["<?php echo JText::_('LNG_BAD') ?>","<?php echo JText::_('LNG_POOR') ?>","<?php echo JText::_('LNG_REGULAR') ?>","<?php echo JText::_('LNG_GOOD') ?>","<?php echo JText::_('LNG_GORGEOUS') ?>"],
		noRatedMsg: "<?php echo JText::_('LNG_NOT_RATED_YET') ?>",
		start:   	  function() { return jQuery(this).attr('title')},
		path:		  '<?php echo JURI::root().'components/com_jbusinessdirectory/assets/images/' ?>',
		readOnly:   true
	});

	loadMapScript();
});
</script>