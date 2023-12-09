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
use \Joomla\CMS\Session\Session;
use Joomla\Utilities\ArrayHelper;

$canEdit = Factory::getApplication()->getIdentity()->authorise('core.edit', 'com_quotation');

if (!$canEdit && Factory::getApplication()->getIdentity()->authorise('core.edit.own', 'com_quotation'))
{
	$canEdit = Factory::getApplication()->getIdentity()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo Text::_('COM_QUOTATION_FORM_LBL_PROPERTY_IP'); ?></th>
			<td><?php echo $this->item->ip; ?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_QUOTATION_FORM_LBL_PROPERTY_PROPERTY_TYPE'); ?></th>
			<td>

			<?php if (!empty($this->item->property_type) || $this->item->property_type === 0)
			{
					 echo Text::_('COM_QUOTATION_PROPERTIES_PROPERTY_TYPE_OPTION_' . strtoupper(str_replace(' ', '_',$this->item->property_type)));
			}
			?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_QUOTATION_FORM_LBL_PROPERTY_PROPERTY_OWNER'); ?></th>
			<td>

			<?php if (!empty($this->item->property_owner) || $this->item->property_owner === 0)
			{
					 echo Text::_('COM_QUOTATION_PROPERTIES_PROPERTY_OWNER_OPTION_' . strtoupper(str_replace(' ', '_',$this->item->property_owner)));
			}
			?></td>
		</tr>

	</table>

</div>

<?php $canCheckin = Factory::getApplication()->getIdentity()->authorise('core.manage', 'com_quotation.' . $this->item->id) || $this->item->checked_out == Factory::getApplication()->getIdentity()->id; ?>
	<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_quotation&task=property.edit&id='.$this->item->id); ?>"><?php echo Text::_("COM_QUOTATION_EDIT_ITEM"); ?></a>
	<?php elseif($canCheckin && $this->item->checked_out > 0) : ?>
	<a class="btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_quotation&task=property.checkin&id=' . $this->item->id .'&'. Session::getFormToken() .'=1'); ?>"><?php echo Text::_("JLIB_HTML_CHECKIN"); ?></a>

<?php endif; ?>

<?php if (Factory::getApplication()->getIdentity()->authorise('core.delete','com_quotation.property.'.$this->item->id)) : ?>

	<a class="btn btn-danger" rel="noopener noreferrer" href="#deleteModal" role="button" data-bs-toggle="modal">
		<?php echo Text::_("COM_QUOTATION_DELETE_ITEM"); ?>
	</a>

	<?php echo HTMLHelper::_(
                                    'bootstrap.renderModal',
                                    'deleteModal',
                                    array(
                                        'title'  => Text::_('COM_QUOTATION_DELETE_ITEM'),
                                        'height' => '50%',
                                        'width'  => '20%',
                                        
                                        'modalWidth'  => '50',
                                        'bodyHeight'  => '100',
                                        'footer' => '<button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button><a href="' . Route::_('index.php?option=com_quotation&task=property.remove&id=' . $this->item->id, false, 2) .'" class="btn btn-danger">' . Text::_('COM_QUOTATION_DELETE_ITEM') .'</a>'
                                    ),
                                    Text::sprintf('COM_QUOTATION_DELETE_CONFIRM', $this->item->id)
                                ); ?>

<?php endif; ?>