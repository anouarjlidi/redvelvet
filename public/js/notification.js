var notificationId = null;

function closeNotification(){
    $('.notification').removeClass('show-notification');
    clearTimeout(notificationId);
}

function showNotification(headerText, contentText){
    $('.notification').addClass('show-notification');
    $('.notification .notification-header p').html(headerText);
    $('.notification .notification-content p').html(contentText);
    notificationId = setTimeout(function(){closeNotification();}, 4000);
}