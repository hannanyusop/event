<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.venue-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}
.venue-list .carousel,.venue-list .card-body {
    width: calc(50%)
}
.venue-list .carousel img.d-block.w-100 {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    min-height: 50vh;
}
span.hightlight{
    background: yellow;
}
.carousel,.carousel-inner,.carousel-item{
   min-height: calc(100%)
}
header.masthead,header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important
    }
.row-items{
    position: relative;
}
.card-left{
    left:0;
}
.card-right{
    right:0;
}
.rtl{
    direction: rtl ;
}
.venue-text{
    justify-content: center;
    align-items: center ;
}

</style>
        <header class="masthead">
        </header>
            <div class="container-fluid mt-3 pt-2">
                <h4 class="text-center text-white">List of Our Event</h4>
                <hr class="divider">
                <div class="row-items">
                <div class="col-lg-12">
                    <div class="row">
                <?php
                $rtl ='rtl';
                $ci= 0;
                $venue = $conn->query("SELECT * from events");
                while($row = $venue->fetch_assoc()){
                   
                    $ci++;
                    if($ci < 3){
                        $rtl = '';
                    }else{
                        $rtl = 'rtl';
                    }
                    if($ci == 4){
                        $ci = 0;
                    }
                ?>
                <div class="col-md-6">
                <div class="card venue-list <?php echo $rtl ?>" data-id="<?php echo $row['id'] ?>">

                    <?php 
                            $main_image = null;
                            $id = $row['id'];
                            $images = array();
                            if(isset($id)){
                                
                                $dir_name = 'admin/assets/uploads/event_'.$id."/";
                                $images = glob($dir_name."*");
                                $cover = [];
                                $active = null;
                                foreach($images as $key => $image) {
                                   $cover[] = $image;
                                   $active = $key;
                                   $main_image = $image;
                                }
                            }
                                
                        ?>
                        <img width="400px" class="img-fluid" src="<?= $main_image ?>" alt="">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center text-center h-100">
                            <div class="">
                                <div>
                                    <h5><b class="filter-txt"><?php echo ucwords($row['event']) ?></b></h3>
                                        <p>
                                            Quota : <?= $row['audience_capacity'] ?> Participants<br>
                                        </p>
                                </div>
                                <div>
                                    <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <br>
                </div>
                <?php } ?>
                </div>
                </div>
                </div>
            </div>


<script>
    // $('.card.venue-list').click(function(){
    //     location.href = "index.php?page=view_venue&id="+$(this).attr('data-id')
    // })

     $('.read_more').click(function(){
         location.href = "index.php?page=view_event&id="+$(this).attr('data-id')
     })
    $('.book-venue').click(function(){
        uni_modal("Submit Regestration Request","booking.php?venue_id="+$(this).attr('data-id'))
    })
    $('.venue-list .carousel img').click(function(){
        viewer_modal($(this).attr('src'))
    })

</script>