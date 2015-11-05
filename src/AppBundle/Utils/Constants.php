<?php

namespace AppBundle\Utils;

class Constants
{
  /**
   * Number of contacts per page
   */
  const CONTACTS_PER_PAGE = 20;

  /**
   * Number of users per page
   */
  const USERS_PER_PAGE = 20;

  /**
   * Contact list order by last name if user don't select any
   *
   */
  const DEFAULT_CONTACT_ORDER = 'lastname';
}
