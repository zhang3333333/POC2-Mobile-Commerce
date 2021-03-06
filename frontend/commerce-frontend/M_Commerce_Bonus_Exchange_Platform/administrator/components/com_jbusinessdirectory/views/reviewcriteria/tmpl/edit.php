<?php
/**
 * @package    JBusinessDirectory
 * @subpackage  com_jbusinessdirectory
 *
 * @copyright   Copyright (C) 2007 - 2015 CMS Junkie. All rights reserved.
 * @license     GNU General Public License version 2 or later; 
 */

defined('_JEXEC') or die('Restricted access');

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {

		var defaultLang="<?php echo JFactory::getLanguage()->getTag() ?>";

		jQuery("#item-form").validationEngine('detach');
		var evt = document.createEvent("HTMLEvents");
		evt.initEvent("click", true, true);
		var tab = ("tab-"+defaultLang);
		if(!(document.getElementsByClassName(tab)[0] === undefined || document.getElementsByClassName(tab)[0] === null))
			document.getElementsByClassName(tab)[0].dispatchEvent(evt);
		if (task == 'reviewcriteria.cancel' || !validateCmpForm()) {
			Joomla.submitform(task, document.getElementById('item-form'));
		}
		jQuery("#item-form").validationEngine('attach');
	}
</script>

<div class="category-form-container">
	<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-horizontal">
		<div class="clr mandatory oh">
			<p><?php echo JText::_("LNG_REQUIRED_INFO")?></p>
		</div>
		<fieldset class="boxed">
			<h2> <?php echo JText::_('LNG_REVIEW_CRITERIA');?></h2>
			<div class="form-box">
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="subject"><?php echo JText::_('LNG_NAME')?> </label> 
					<?php 
						if($this->appSettings->enable_multilingual) {
							$options = array(
								'onActive' => 'function(title, description){
									description.setStyle("display", "block");
									title.addClass("open").removeClass("closed");
								}',
								'onBackground' => 'function(title, description){
									description.setStyle("display", "none");
									title.addClass("closed").removeClass("open");
								}',
								'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
								'useCookie' => true, // this must not be a string. Don't use quotes.
							);
							echo JHtml::_('tabs.start', 'tab_groupsd_id', $options);
							foreach( $this->languages  as $k=>$lng ) {
								echo JHtml::_('tabs.panel', $lng, 'tab-'.$lng );
								$langContent = isset($this->translations[$lng."_name"])?$this->translations[$lng."_name"]:"";
								if($lng==JFactory::getLanguage()->getTag() && empty($langContent)){
									$langContent = $this->item->name;
								}
								echo "<input type='text' name='name_$lng' id='name_$lng' class='input_txt validate[required]' value=\"".stripslashes($langContent)."\"  maxLength='100'>";
								echo "<div class='clear'></div>";
							}
							echo JHtml::_('tabs.end');
						} else { ?>
							<input type="text" name="name" id="name" class="input_txt validate[required]" value="<?php echo $this->item->name ?>"  maxLength="100">
						<?php } ?>
					<div class="clear"></div>
				</div>
			</div>
		</fieldset>
		<input type="hidden" name="option" value="<?php echo JBusinessUtil::getComponentName()?>" /> 
		<input type="hidden" name="task" id="task" value="" />
		<input type="hidden" name="id" value="<?php echo $this->item->id ?>" /> 
		<input type="hidden" name="view" id="view" value="reviewcriteria" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
</div>

<script>
	function validateCmpForm() {
		var isError = jQuery("#item-form").validationEngine('validate');
		return !isError;
	}
</script>