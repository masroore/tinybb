<?php
/**
 * $Id:$
 * Date: 7/27/12
 * Time: 6:36 AM
 */
class EForumUser extends CWebUser
{
    protected $_model;

    // loads the specified user
    protected function loadUser()
    {
        if ($this->_model === null) {
            $this->_model = User::model()->findByPk($this->id);
        }

        return $this->_model;
    }

    // returns true if the logged in user is an administrator
    public function isAdmin()
    {
        $user = $this->loadUser();
        if ($user) {
            return ($user->is_admin === 1 && $user->is_active === 1);
        }
        return false;
    }
}
