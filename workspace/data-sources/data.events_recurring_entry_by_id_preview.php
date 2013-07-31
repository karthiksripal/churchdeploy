<?php

	require_once(TOOLKIT . '/class.datasource.php');

	Class datasourceevents_recurring_entry_by_id_preview extends SectionDatasource {

		public $dsParamROOTELEMENT = 'events-recurring-entry-by-id-preview';
		public $dsParamORDER = 'desc';
		public $dsParamPAGINATERESULTS = 'no';
		public $dsParamLIMIT = '20';
		public $dsParamSTARTPAGE = '1';
		public $dsParamREDIRECTONEMPTY = 'no';
		public $dsParamREQUIREDPARAM = '$pt3';
		public $dsParamPARAMOUTPUT = array(
				'verses'
		);
		public $dsParamSORT = 'system:id';
		public $dsParamHTMLENCODE = 'yes';
		public $dsParamASSOCIATEDENTRYCOUNTS = 'no';
		public $dsParamCACHE = '0';
		

		public $dsParamFILTERS = array(
				'id' => '{$pt1},{$pt3}',
				'214' => 'yes',
		);
		

		public $dsParamINCLUDEDELEMENTS = array(
				'name: formatted',
				'frequency: unformatted',
				'description: unformatted',
				'locations: name-formal: formatted',
				'locations: description: formatted',
				'locations: address',
				'locations: city',
				'locations: state',
				'locations: zip',
				'locations: latitude',
				'locations: longitude',
				'tags: tag: unformatted',
				'downloads: file',
				'downloads: link',
				'images: image',
				'images: height',
				'images: color',
				'images: background',
				'verses: passage'
		);
		

		public function __construct($env=NULL, $process_params=true) {
			parent::__construct($env, $process_params);
			$this->_dependencies = array();
		}

		public function about() {
			return array(
				'name' => 'Events: Recurring: Entry by ID (preview)',
				'author' => array(
					'name' => 'Jonathan Simcoe',
					'website' => 'http://atheycreek',
					'email' => 'jdsimcoe@gmail.com'),
				'version' => 'Symphony 2.3.2',
				'release-date' => '2013-07-09T22:45:21+00:00'
			);
		}

		public function getSource() {
			return '21';
		}

		public function allowEditorToParse() {
			return true;
		}

		public function execute(array &$param_pool = null) {
			$result = new XMLElement($this->dsParamROOTELEMENT);

			try{
				$result = parent::execute($param_pool);
			}
			catch(FrontendPageNotFoundException $e){
				// Work around. This ensures the 404 page is displayed and
				// is not picked up by the default catch() statement below
				FrontendPageNotFoundExceptionHandler::render($e);
			}
			catch(Exception $e){
				$result->appendChild(new XMLElement('error', $e->getMessage()));
				return $result;
			}

			if($this->_force_empty_result) $result = $this->emptyXMLSet();

			return $result;
		}

	}
