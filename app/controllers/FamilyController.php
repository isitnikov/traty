<?php

class FamilyController extends AbstractController
{
    public function viewAction()
    {
        $user = App::getUser();
        $family = new Family();
        $hasInvite = $family->checkUnconfirmedInvites($user);

        require APP_TEMPLATES_PATH . 'family' . DIRECTORY_SEPARATOR . 'view.php';
    }

    public function inviteAction()
    {
        $username = App::getRequest('username');
        $fromUserId = App::getRequest('from');

        $fromUser = new User();
        $fromUser->load($fromUserId);

        $invitedUser = new User();
        $invitedUser->setUsername($username);
        $invitedUser->loadUserByUsername();

        $family = $fromUser->family();
        if (!$family->getId()) {
            $family->setHash(GeneralHelper::hash(time()));
            $family->save();
        }

        $confirmed = 1;
        $family->assign($fromUser, $confirmed);
        $family->assign($invitedUser, !$confirmed);

        GeneralHelper::redirect();
    }

    public function acceptAction()
    {
        $accept = App::getRequest('accept');

        $family = new Family();
        $row = $family->checkUnconfirmedInvites(App::getUser());
        if ($accept === false) {
            if ($row) {
                $family->load($row['family_id']);
                $family->unAssign(App::getUser());
                echo "Not accepted";
                return;
            }
        } else {
            if ($row) {
                $family->load($row['family_id']);
                $family->assign(App::getUser(), 1);
                echo "Accepted";
                return;
            }
        }

        echo "Invite not found";
    }
}
