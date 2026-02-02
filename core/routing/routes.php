<?php
// return [
//     '/' => 'controller/home/index.controller.php',
//     '/login' => 'controller/auth/initAuth.controller.php',
// ];

$router->get('/', 'controller/home/index.controller.php');
$router->get('/api/user_logs', 'controller/api/user_logs.php');

$router->post('/postDevice', 'controller/dashboards/admin/postDevice.php');
$router->patch('/updateStatus', 'controller/dashboards/admin/updateStatus.php');

$router->get('/signup', 'controller/auth/signup/signup.php');
$router->post('/signup', 'controller/auth/signup/signup_post.php');

$router->get('/login', 'controller/auth/login/initAuth.php');
$router->post('/login', 'controller/auth/login/login_post.php');

$router->get('/terms', 'view/terms-privacy/terms.php');
$router->get('/privacy', 'view/terms-privacy/privacy.php');

$router->get('/logout', 'controller/auth/logout.php');

$router->post('/feedback', 'controller/dashboards/user/feedback.php');
$router->post('/membership', 'controller/dashboards/user/membership.php');

$router->post('/pay', 'controller/dashboards/user/payment.php');
$router->get('/payment_success', 'controller/dashboards/user/paymentConfirmation.php');

//user 
$router->put('/update', 'controller/dashboards/user/update.php');
$router->delete('/destroy', 'controller/dashboards/user/destroy.php');

$router->get('/Team', 'controller/home/team.controller.php');
$router->get('/gallery', 'controller/home/fullGallery.controller.php');

$router->get('/userdashboard', 'controller/dashboards/user/user.php');
$router->get('/adminDashboard', 'controller/dashboards/admin/get.php');

//admin
$router->delete('/userDelete', 'controller/dashboards/admin/deleteUser.php');
$router->delete('/deletePayment', 'controller/dashboards/admin/deletePayment.php');
$router->delete('/deleteFeedback', 'controller/dashboards/admin/deleteFeedback.php');

$router->patch('/updateMembership', 'controller/dashboards/admin/patch.php');
$router->patch('/reply', 'controller/dashboards/admin/reply.php');
$router->patch('/updateInfo', 'controller/dashboards/admin/adminInfo.php');
$router->patch('/updatePlanPrice', 'controller/dashboards/admin/updatePlanPrice.php');

$router->post('/createAnnouncement', 'controller/dashboards/admin/createAnnouncement.php');
$router->delete('/deleteAnnouncement', 'controller/dashboards/admin/deleteAnnouncement.php');


