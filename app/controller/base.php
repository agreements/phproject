<?php

namespace Controller;

abstract class Base {

	// Require a user to be logged in. Redirects to /login if a session is not found.
	protected function _requireLogin() {
		$f3 = \Base::instance();
		if($id = $f3->get('user.id')) {
			return $id;
		} else {
			$f3->reroute("/login?redirect=" + urlencode("testy"));
			$f3->unload();
			return false;
		}
	}

	// Require a user to be an administrator. Throws HTTP 403 if logged in, but not an admin.
	protected function _requireAdmin() {
		$id = $this->_requireLogin();

		$f3 = \Base::instance();
		if($f3->get("user.role") == "admin") {
			return $id;
		} else {
			$f3->error(403);
			$f3->unload();
			return false;
		}
	}

}
