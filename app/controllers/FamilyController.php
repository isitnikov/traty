<?php

class FamilyController extends AbstractController
{
    public function viewAction()
    {
        $user = App::getUser();
        $userFamily = $user->family();
        $members = array();
        if ($userFamily->getId()) {
            $members = $userFamily->members(1);
        }
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

        $family = $invitedUser->family();
        if ($family->getId()) {
            $members = $family->members(1);
            if (in_array($invitedUser->getId(), GeneralHelper::getIdsFromArrayOfObjects($members))) {
                App::addErrorAlert('Пользователю не может быть отправлено приглашение, он уже состоит в группе');
                GeneralHelper::redirect();
            }
        }

        $family = $fromUser->family();
        if (!$family->getId()) {
            $family->setHash(GeneralHelper::hash(time()));
            $family->save();
        }



        $confirmed = 1;
        $family->assign($fromUser, $confirmed);
        $family->assign($invitedUser, !$confirmed);

        App::addSuccessAlert('Приглашение отправлено пользователю ' . GeneralHelper::escape($username));
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
                App::addErrorAlert('Вы успешно отказались от приглашения');
                GeneralHelper::redirect();
            }
        } else {
            if ($row) {
                $family->load($row['family_id']);
                $family->assign(App::getUser(), 1);
                App::addSuccessAlert('Вы присоединились к общему аккаунту');
                GeneralHelper::redirect();
            }
        }

        App::addErrorAlert('Не существует инвайта для этого пользователя');
        GeneralHelper::redirect();
    }

    public function removeAction()
    {
        $userId = App::getRequest('user_id');
        $user = new User();
        $user->load($userId);

        $family = App::getUser()->family();
        if (!$family->getId()) {
            App::addErrorAlert();
            GeneralHelper::redirect();
        }

        $members = $family->members(0);
        if (empty($members)) {
            App::addErrorAlert();
            GeneralHelper::redirect();
        }

        $memberIds = array();
        foreach ($members as $member) {
            $memberIds[] = $member->getId();
        }
        if (in_array($userId, $memberIds)) {
            $family->unAssign($user);
            App::addSuccessAlert();
            GeneralHelper::redirect();
        }

    }
}
