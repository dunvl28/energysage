<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Quotation
 * @author     Thomas Nguyen <nguyenvuledu@gmail.com>
 * @copyright  2023 Thomas Nguyen
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;
use \Energyquotation\Component\Quotation\Site\Helper\QuotationHelper;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');
HTMLHelper::_('bootstrap.tooltip');

// Load admin language file
$lang = Factory::getLanguage();
$lang->load('com_quotation', JPATH_SITE);

$user    = Factory::getApplication()->getIdentity();
$canEdit = QuotationHelper::canUserEdit($this->item, $user);

$this->document->addStyleSheet(Uri::root().'components/com_quotation/assets/style.css');

?>

<div class="property-edit front-end-edit">

		<form id="form-property"
			  action="<?php echo Route::_('index.php?option=com_quotation&view=propertyform&layout=step1'); ?>"
			  method="post" class="form-validate form-horizontal" enctype="multipart/form-data">

			<div class="row">
				<div class="landing-banner">
					<div class="banner-content">
						<div class="banner-content-first"><span class="banner-content-h1 mb-50 mb-lg-100">Compare and save on clean home energy solutions</span></div>
						<div class="banner-content-second px-5"><span class="banner-content-p">Research and shop through our network of pre-screened, local installers.</span><form action="">
								<div class="row justify-content-center mt-5">
									<div class="col-md-5 mx-2 input-holder-zipcode">
										<div class="zip-code-icon"><img src="/energysage/images/energy/zip-code-icon.png" width="24" height="24" loading="lazy" data-path="local-images:/energy/zip-code-icon.png"></div>
										<input id="property_ip" class="zip-code" maxlength="5" name="jform[ip]" type="text" placeholder="ZIP code"></div>
									<div class="col-md-5 mx-2 contain-zip-button"><button class="btn btn-primary zip-button" type="submit">Shop local offers</button></div>
								</div>
								<div class="mt-4 banner-lock-item">
									<div class="mr-1 banner-lock-white"><img src="/energysage/images/energy/banner-lock.png" width="24" height="24" loading="lazy" data-path="local-images:/energy/banner-lock.png"></div>
									<div class="mr-1 banner-lock-black"><img src="/energysage/images/energy/banner-lock-black.png" width="24" height="24" loading="lazy" data-path="local-images:/energy/banner-lock-black.png"></div>
									<div>Your information is safe with us. Privacy Policy.</div>
								</div>
							</form></div>
					</div>
				</div>
				<div class="banner-image">
					<img src="/energysage/images/energy/banner.png" loading="lazy" data-path="local-images:/energy/banner.png">
				</div>
			</div>
			
			<input type="hidden" name="jform[id]" value="<?php echo isset($this->item->id) ? $this->item->id : ''; ?>" />
			<input type="hidden" name="jform[state]" value="<?php echo isset($this->item->state) ? $this->item->state : ''; ?>" />
			<input type="hidden" name="jform[ordering]" value="<?php echo isset($this->item->ordering) ? $this->item->ordering : ''; ?>" />
			<input type="hidden" name="jform[checked_out]" value="<?php echo isset($this->item->checked_out) ? $this->item->checked_out : ''; ?>" />
			<input type="hidden" name="jform[checked_out_time]" value="<?php echo isset($this->item->checked_out_time) ? $this->item->checked_out_time : ''; ?>" />

			<?php echo $this->form->getInput('created_by'); ?>
			<?php echo $this->form->getInput('modified_by'); ?>

	<?php echo $this->form->renderField('ip'); ?>

			<div class="controls" aria-describedby="jform[property_type]-desc">
				<fieldset id="jform_property_type" class="quotation_form_fieldsets">
					<h1><?php echo Text::_('COM_QUOTATION_FORM_PROPERTY_TYPE_TITLE');?></h1>
					<div class="required radio" required="">
						<div class="row-fluid">
							<input type="radio" name="jform[property_type]" required="" class="btn-check" checked id="jform_property_type0" value="Home" autocomplete="off">
							<label class="btn btn-outline-secondary" for="jform_property_type0">Home</label>
						</div>
						<div class="row-fluid">
							<input type="radio" name="jform[property_type]" required="" class="btn-check" id="jform_property_type1" value="Business" autocomplete="off">
							<label class="btn btn-outline-secondary" for="jform_property_type1">Business</label>
						</div>
						<div class="row-fluid">
							<input type="radio" name="jform[property_type]" required="" class="btn-check" id="jform_property_type2" value="Nonprofit" autocomplete="off">
							<label class="btn btn-outline-secondary" for="jform_property_type2">Nonprofit</label>
						</div>
					</div>
				</fieldset>
			</div>

			<div class="controls" aria-describedby="jform[property_type_owner]-desc">
				<fieldset id="jform_property_type_owner" class="quotation_form_fieldsets">
					<h1><?php echo Text::_('COM_QUOTATION_FORM_PROPERTY_TYPE_OWNER_TITLE');?></h1>
					<div class="required radio" required="">
						<div class="row-fluid">
							<input type="radio" name="jform[property_owner]" required="" class="btn-check" checked id="jform_property_owner0" value="Home" autocomplete="off">
							<label class="btn btn-outline-secondary" for="jform_property_owner0">Home</label>
						</div>
						<div class="row-fluid">
							<input type="radio" name="jform[property_owner]" required="" class="btn-check" id="jform_property_owner1" value="Business" autocomplete="off">
							<label class="btn btn-outline-secondary" for="jform_property_owner1">Business</label>
						</div>
					</div>
				</fieldset>
			</div>

			<div class="control-group">
				<div class="controls">

					<?php if ($this->canSave): ?>
						<button type="submit" class="validate btn btn-primary">
							<span class="fas fa-check" aria-hidden="true"></span>
							<?php echo Text::_('JSUBMIT'); ?>
						</button>
					<?php endif; ?>
					<a class="btn btn-danger"
					   href="<?php echo Route::_('index.php?option=com_quotation&task=propertyform.cancel'); ?>"
					   title="<?php echo Text::_('JCANCEL'); ?>">
					   <span class="fas fa-times" aria-hidden="true"></span>
						<?php echo Text::_('JCANCEL'); ?>
					</a>
				</div>
			</div>

			<input type="hidden" name="option" value="com_quotation"/>
			<input type="hidden" name="task" value="propertyform.save"/>
			<?php echo HTMLHelper::_('form.token'); ?>
		</form>
</div>
