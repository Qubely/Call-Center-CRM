$(document).ready(function(){

    if(socket) {
        socket.on('publish_content',(data)=>{
            //show user notification
            console.log(data);
            $("#notificationBar").append(data?.data);
            $("#notiCount").text(parseInt($("#notiCount").text())+1)
            PX?.inflatesuccess('You have new notification');
        });
    }

    $(".testSocket").on("click",function(){
         console.log(socket);
         if(socket) {

            let html  = `<a href="javascript:void(0);" class="text-dark notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bxs-user-plus fs-18"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">A new agent signing </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">a new agent <b> Mr. X</b> just requested to add to system, waiting for approval</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>`;
            socket.emit('publish_content',{data: html})
        }
    })

});
