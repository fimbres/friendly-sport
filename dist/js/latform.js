"use strict";

/**
 *
 *  Project name: Latform - Login and Register Form Templates
 *
 *  File name: latform.js
 *
 *  Autor: Laborasyon
 *
 *  Portfolio: https://themeforest.net/user/laborasyon/portfolio
 *
 */
$(function () {
  $(document).on('click', '.password-show-hide', function () {
    return false;
  }).on('mousedown', '.password-show-hide', function () {
    $(this).closest('.form-icon-wrapper').find('input').prop('type', 'text');
    return false;
  }).on('mouseup', '.password-show-hide', function () {
    $(this).closest('.form-icon-wrapper').find('input').prop('type', 'password');
    return false;
  });
});