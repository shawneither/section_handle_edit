<?php
	/*
	* To Do:
	* Catch and output errors on handle create/edit:
	*  - handle already exists in other section
	*  - handle must be 'handle-ized'
	*/
	

	require_once(TOOLKIT . '/class.entrymanager.php');
	require_once(TOOLKIT . '/class.sectionmanager.php');

	Class Extension_Section_Handle_Edit extends Extension{

		public function __construct($args) {
			$this->_Parent =& $args['parent'];
		}
	
		public function getSubscribedDelegates(){
			return array(
				array(
					'page' => '/blueprints/sections/',
					'delegate' => 'AddSectionElements',
					'callback' => 'addSectionSettings'
				),
				array(
					'page'		=> '/blueprints/sections/',
					'delegate'	=> 'SectionPreCreate',
					'callback'	=> 'saveSectionSettings'
				),
				array(
					'page'		=> '/blueprints/sections/',
					'delegate'	=> 'SectionPreEdit',
					'callback'	=> 'saveSectionSettings'
				)
			);
		}

		
	/*-------------------------------------------------------------------------
		Delegates
	-------------------------------------------------------------------------*/

		public function addSectionSettings($context) {

			$label = Widget::Label(__('Handle'));
			$label->appendChild(Widget::Input('meta[name]', General::sanitize($meta['name'])));
		
			$setting = array('value' => $context['meta']['handle']);
		
			$label = new XMLElement('label', __('Handle'));
			$label->appendChild(new XMLElement('input', '', array_merge($setting, array('name' => 'meta[handle]', 'type' => 'text'))));

			// Find context
			$fieldset = $context['form']->getChildren();
			$group = $fieldset[0]->getChildren();
			$column = $group[1]->getChildren();

			$column[0]->insertChildAt(1, $label);
		}
		
		public function saveSectionSettings($context) {

			// $section_id = $context['section']; // not needed?

			/* Creating:
			 *    $_POST['meta']['handle'] is empty is if not specified in field
			      $context['meta']['handle'] is always made from section name (?) - yes, a handlized version
			 * Editing: 
			*/
			$handle = $_POST['meta']['handle'];

			
			if(!empty($handle)) {
				if($this->checkHandleForDuplicate($handle)) {
					$context['meta']['handle'] = $handle;
				}
				else {
					return;
				}
			}
		}
		
	/*-------------------------------------------------------------------------
		Helpers
	-------------------------------------------------------------------------*/

		private function checkHandleForDuplicate($section_handle)
		{
			if(Symphony::Database()->fetchRow(0, "SELECT * FROM `tbl_sections` WHERE `handle` = '" . $section_handle . "'")) {
				return false;
			}
			return true;
		}
	}
