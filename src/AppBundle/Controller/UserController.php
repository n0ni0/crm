<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\UserRepository;
use AppBundle\Entity\User;
use AppBundle\Utils\Constants;

class UserController extends Controller
{
  /**
   * @route("/users/list", name="listUsers")
   */
  public function listUsersAction(Request $request)
  {
    $user = $this->get('UserManager')->findAllUsers();

    if(!$user){
      throw $this->createNotFoundException('User not found');
    }

    $paginator  = $this->get('knp_paginator');
    $users      = $paginator->paginate(
    $user,
    $request->query->getInt('page',1), $pages = Constants::USERS_PER_PAGE
    );

    return $this->render('users/userList.html.twig', array(
      'users'  => $users
    ));
  }

  /**
   * @route("/user/{id}/delete", name="deleteUser")
   */
  public function deleteUserAction($id)
  {
    $user = $this->get('UserManager')->deleteUser($id);

    return $this->redirectToRoute('listUsers');
  }
}
