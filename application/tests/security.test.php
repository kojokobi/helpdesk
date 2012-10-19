<?php

	class SecurityTest extends TestControllerBase{

		public function test_create_module_permission()
		{
			$parameters = '{}'
			$response = Controller::call('security@module_permission',)
		}
		public function test_get_roles(){

			$response = $this->get('home@roles');
			$this->assertEquals();
		}

	}