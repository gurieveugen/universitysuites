<?php
namespace Admin;

class Section extends BaseWithControls{
	//                                       __  _          
	//     ____  _________  ____  ___  _____/ /_(_)__  _____
	//    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
	//   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
	//  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
	// /_/              /_/                                 
	private $prefix;		

	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($title, $args = array(), \Controls\ControlsCollection $controls = null)
	{
		$args = array_merge(array('class' => ''), $args);
		parent::__construct($title, $args, $controls);
		$this->prefix = isset($this->options['prefix']) ? $this->options['prefix'] : $this->name.'_';
	}

	/**
	 * Get section HTML
	 * @return string --- HTML code
	 */
	public function getHTML()
	{
		$title  = sprintf('<h3>%s</h3>', $this->title);
		$values = $this->getSectionValues();
		return sprintf(
			'<div class="group basicsettings" id="options-group-%s">%s</div>',
			$this->name,
			sprintf(
				'%s <div class="section-wrapper">%s</div>',
				$title,
				$this->controls->getHTML($values)		
			)
		);
	}

	/**
	 * Get all saved values
	 * @return mixed --- if success function return array | null if not
	 */
	private function getSectionValues()
	{
		if(!$this->controls) return null;

		$values = array();
		$tmp    = $this->controls->getControls();			
		foreach ($tmp as &$ctrl) 
		{
			$values[$ctrl->getName()] = get_option($ctrl->getName());
		}				
		return $values;
	}

	public function getPrefix()
	{
		return $this->prefix;
	}

}