<?php
require_once "api/classes/Db.php";
require_once "api/classes/Bird.php";
include("includes/header.php");
?>
<section class="main-item">


    <!-- Main Raccoons contents with sorting  -->
    <div id="status"></div>

    <div class="rac-container" id="detail-area">
        <div class="rac-info">

            <span>Total result <strong>: <?php

                    $bird = new Bird();

                    $total_result = $bird->getTotal();
                    $total = $bird->total;
                    echo $total;

                    ?></strong> </span>
                <span>
                   Sort by :
                   <select name="nameSort" id="nameSort">
                       <option value="asc" id="asc">Asc Order</option>
                       <option value="desc" id="desc">Desc order</option>
                   </select>
                   <select name="ratingSort" id="ratingSort">
                       <option value="highest" id="highest">Highest rating</option>
                       <option value="lowest" id="lowest">Lowest rating</option>
                   </select>
              </span>
              <h2 style="text-align:center;">Review of Birds</h2>
        </div>

        <div id="new-list">


        </div>

        <div class="php-loop">
            <?php

            $img_url =  "assets\\images\\";
            $result = $bird->getAllBirds();

            foreach ($result as $bird) {

                ?>

                <div class="rac-list" id="first-rac">

                    <img src="<?php echo $img_url.$bird->getImageUrl(); ?>" alt="">
                    <p>Id : <strong><?php echo $bird->getId(); ?>  </strong></p>
                    <p>Name : <strong><?php echo $bird->getName(); ?>  </strong></p>
                    <p>Review : <strong>
                            <?php
                            $total_result = $bird->getTotalReview($bird->getId());
                            echo $total_result['total_review']; ?></strong></p>
                    <p>Order : <?php echo $bird->getOrder(); ?></p>
                    <p>Binomial Name : <?php echo $bird->getBinomialName(); ?></p>
                    <p>Species : <?php echo $bird->getSpecies(); ?></p>
                    <p>Genus : <?php echo $bird->getGenus(); ?></p>
                    <p>Family : <?php echo $bird->getFamily() ?></p>
                    <br>
                    <br>
                    <br>
                    <a id="#hrefs" value="<?php echo $bird->getId(); ?>"
                       onclick="detail(<?php echo $bird->getId(); ?>)">Detail about <?php echo $bird->getName(); ?></a>
                </div>
            <?php } ?>

        </div>

    </div>

</section>

<div class="detail-container">

    <div class="sum-list" id="detail-link">
    </div>

    <section class="rac-detail">
        <img id="racoon-img" src="" alt="">

        <div class="about-racs">

        </div>

    </section>
    <section class="user-review">
        <div class="user-comments">

        </div>
        <div id="review-wrapper-div" class="review-wrapper-div"></div>

        <div class="user-rac-rate" id="update-rac">

        </div>

    </section>
    <div class="new-review-button" id="mg-section">


        <div class="button">

        </div>
        <div class="user-comment" id="user-comment">

            <input type="text" name="username" id="username" placeholder="Your name" required>
            <input type="email" name="email" id="email" placeholder="your email" required>
            <p>How much you want to rate this ? &nbsp;&nbsp;&nbsp; <span class="radio-toolbar">
                    <select id="rate-value">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </span>
                </p>
                
                
            &nbsp; &nbsp; &nbsp; &nbsp;
            <span>Your Password &nbsp; &nbsp; <input type="password" id="user-password" placeholder="your Password "> &nbsp; &nbsp; &nbsp;</span>

            <p>
                <textarea id="review-text" cols="30" rows="10"></textarea>
            </p>
            <div class="button-area" id="comment-box-show">
                <input type="submit" onclick="ajax_posts()" value="Post">
                <input type="button" onclick="hideBox()" id="cancel" value="Cancel">
            </div>

        </div>
    </div>
</div> 
<script>

    var birdId = '';
    var reviewId = '';

    
    $(document).on("change","#nameSort", function(){

        let seleceted = $(this).find(":selected").text();
        switch(seleceted) {
            case "Asc Order":
                
                 $(".php-loop").hide();
                    var url = baseUrl + "api/bird/sortByAsc";
                    $.get(url, function (data, status) {
                        var data = JSON.parse(data);
                        var asc = '';

                        $.each(data, function (key, datas) {

                            asc += '<div id="new-rac-list" class="rac-list">';
                            asc += '<img src="assets//images//' + datas.imageUrl + '" alt="' + datas.name + '" >';
                            asc += '<p>Name : <strong>' + datas.name + '</strong></p>';
                            asc += '<p>Review : <strong>45</strong></p>';
                            asc += '<p>Order : '+ datas._order +'</p>';
                            asc += '<p>Binomial Name : '+ datas.binomial_name +' <p>';
                            asc += '<p>Species : '+ datas.species +'</p>';
                            asc += '<p>Genus : '+ datas.genus +'</p>';
                            asc += '<p><p>Family : '+ datas.family +'</p>';
                            asc += '<br><br><br>';
                            asc += '<a id="#hrefs" value="' + datas.id + '" onclick="detail(' + datas.id + ')">Detail about Raccon</a>';
                            asc += '</div>';


                        })

                        $("#new-list").html(asc);

                    });


                break;

            case "Desc order":
                
                 $(".php-loop").hide();
                var url = baseUrl + "api/bird/getBySortByDesc";
                $.get(url, function (data, status) {
                    console.log(data);
                    var data = JSON.parse(data);
                    var asc = '';

                    $.each(data, function (key, datas) {
                        
                        asc += '<div id="new-rac-list" class="rac-list">';
                        asc += '<img src="assets//images//' + datas.imageUrl + '" alt="' + datas.name + '" >';
                        asc += '<p>Name : <strong>' + datas.name + '</strong></p>';
                        asc += '<p>Review : <strong>45</strong></p>';
                        asc += '<p>Order : '+ datas._order +'</p>';
                        asc += '<p>Binomial Name : '+ datas.binomial_name +' <p>';
                        asc += '<p>Species : '+ datas.species +'</p>';
                        asc += '<p>Genus : '+ datas.genus +'</p>';
                        asc += '<p><p>Family : '+ datas.family +'</p>';
                        asc += '<br><br><br>';
                        asc += '<a id="#hrefs" value="' + datas.id + '" onclick="detail(' + datas.id + ')">Detail about Raccon</a>';
                        asc += '</div>';

                    });

                    $("#new-list").html(asc);

                });


                break;

            default:
                alert("Error Occured");
        }

    });

    $(document).on("change","#ratingSort", function(){
        
        let seleceted = $(this).find(":selected").text();
        switch(seleceted) {
            case "Highest rating":
               
                $(".php-loop").hide();
                var url = baseUrl + "api/bird/getByRateHigh";
                $.get(url, function (data, status) {

                    var data = JSON.parse(data);
                    var asc = '';

                    $.each(data, function (key, datas) {
                        
                        asc += '<div id="new-rac-list" class="rac-list">';
                        asc += '<img src="assets//images//' + datas.imageUrl + '" alt="' + datas.name + '" >';
                        asc += '<p>Name : <strong>' + datas.name + '</strong></p>';
                        asc += '<p>Review : <strong>45</strong></p>';
                        asc += '<p>Order : '+ datas._order +'</p>';
                        asc += '<p>Binomial Name : '+ datas.binomial_name +' <p>';
                        asc += '<p>Species : '+ datas.species +'</p>';
                        asc += '<p>Genus : '+ datas.genus +'</p>';
                        asc += '<p><p>Family : '+ datas.family +'</p>';
                        asc += '<br><br><br>';
                        asc += '<a id="#hrefs" value="' + datas.id + '" onclick="detail(' + datas.id + ')">Detail about Raccon</a>';
                        asc += '</div>';

                    });
                    $("#new-list").html(asc);

                });
 

                break;

            case "Lowest rating":
                
                $(".php-loop").hide();
                var url = baseUrl + "api/bird/getByRateLow";
                $.get(url, function (data, status) {
                    var data = JSON.parse(data);
                    var asc = '';

                    $.each(data, function (key, datas) {
                        
                        asc += '<div id="new-rac-list" class="rac-list">';
                        asc += '<img src="assets//images//' + datas.imageUrl + '" alt="' + datas.name + '" >';
                        asc += '<p>Name : <strong>' + datas.name + '</strong></p>';
                        asc += '<p>Review : <strong>45</strong></p>';
                        asc += '<p>Order : '+ datas._order +'</p>';
                        asc += '<p>Binomial Name : '+ datas.binomial_name +' <p>';
                        asc += '<p>Species : '+ datas.species +'</p>';
                        asc += '<p>Genus : '+ datas.genus +'</p>';
                        asc += '<p><p>Family : '+ datas.family +'</p>';
                        asc += '<br><br><br>';
                        asc += '<a id="#hrefs" value="' + datas.id + '" onclick="detail(' + datas.id + ')">Detail about Raccon</a>';
                        asc += '</div>';

                    })

                    $("#new-list").html(asc);

                });

                break;

            default:
                alert("Error Occured");
        }

    });




    // // Highest Rating

    // $(".rac-container .rac-info #ratingSort #highest").click(function () {

    //     $(".php-loop").hide();
    //     var url = baseUrl + "api/bird/getByRateHigh";
    //     $.get(url, function (data, status) {
    //         var data = JSON.parse(data);
    //         var asc = '';

    //         $.each(data, function (key, datas) {
                
    //             asc += '<div id="new-rac-list" class="rac-list">';
    //             asc += '<img src="assets//images//' + datas.imageUrl + '" alt="' + datas.name + '" >';
    //             asc += '<p>Name : <strong>' + datas.name + '</strong></p>';
    //             asc += '<p>Review : <strong>45</strong></p>';
    //             asc += '<p>Order : '+ datas._order +'</p>';
    //             asc += '<p>Binomial Name : '+ datas.binomial_name +' <p>';
    //             asc += '<p>Species : '+ datas.species +'</p>';
    //             asc += '<p>Genus : '+ datas.genus +'</p>';
    //             asc += '<p><p>Family : '+ datas.family +'</p>';
    //             asc += '<br><br><br>';
    //             asc += '<a id="#hrefs" value="' + datas.id + '" onclick="detail(' + datas.id + ')">Detail about Raccon</a>';
    //             asc += '</div>';

    //         })

    //         $("#new-list").html(asc);

    //     });

    // });


    // // Lowest

    // $(".rac-container .rac-info #ratingSort #lowest").click(function () {

        

    // });


    function detail(obj, takeme= false) {

        api_url = baseUrl + "api/bird/" + obj; 
        var url = baseUrl + "api/bird/" + obj;
        $.get(url, function (data, status) {
            var data = JSON.parse(data);
            data = JSON.parse(data);
            birdId = obj;

            // Rating
            // (252*5 + 124*4 + 40*3 + 29*2 + 33*1) / (252 + 124 + 40 + 29 + 33)
            //

            // Description
            
            var detail = '<p><strong>Detail</strong> of ' + data.name + '</p> <a id="reload-home">Return to Home</a>';
            $(".sum-list").html(detail);

            $("#racoon-img").attr('src', 'assets//images//'+data.imageUrl);

            // description
            var description = '';
            description += '<p><big><strong>Description </strong></big> </p>';
            description += '<p>Name              <strong> = ' + data.name + '</strong> </p>';
            description += '<p>Total Review      <strong>'+ data.totalReview +'</strong> </p>';
            description += '<p>Average Rating    <strong>'+ data.averageRating +'</strong> </p>';
            description += '<p>Order : '+ data._order +'</p>';
            description += '<p>Binomial Name : '+ data.binomial_name +' <p>';
            description += '<p>Species : '+ data.species +'</p>';
            description += '<p>Genus : '+ data.genus +'</p>';
            description += '<p><p>Family : '+ data.family +'</p>';


            $(".about-racs").html(description);

            // User comments

            var comments = '<p>User Comments for '+ data.name +'</p>';

            $(".user-comments").html(comments);


            // Button
            var button = '<button class="long-button" onclick="newSection(' + data.id + ')" id="bt-comment" >Click here to add your new Comment</button>';
            $(".button").html(button);

            var html = '';
            $.each(data.reviews, function (key, review) {

                var t = review.post_date.split(/[- :]/);
                var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));

                html += '<div class="user-rac-rate" id="rac-'+review.id+'">';
                html += '<p>Username = <strong>' + review.name + '</strong> &nbsp;&nbsp;&nbsp;&nbsp;Rating = <strong>' + review.rating + '</strong> &nbsp;&nbsp;&nbsp; Viewer Mail = <strong>' + review.viewer_email +  '</strong> &nbsp;&nbsp;&nbsp; Comment post date = <strong>' + d +  '</strong>';
                html += '<select '
                html += 'data-id="' + review.id + '"';
                html += ' onchange="changeOption(this,' + review.id + ','+data.id+')">';
                html += '<option value="null">Select</option>';
                html += '<option value="update">Update</option>';
                html += '<option value="delete">Delete</option>';
                html += '</select>';
                html += '</p><p>';
                html += review.reviewText;
                html += '</p></div>';


            })


            document.getElementById("user-comment").style.display = "none";
            $("#detail-area").remove();
            $("#review-wrapper-div").html(html);
            window.location.href= baseUrl+"#detail-link";
            if(takeme === true) {
                $('html, body').scrollTop( $(document).height());
            }
            
        });

    }

    document.getElementById("nameSort").style.display = "inline";

    $("#rac-list a").click(function (event) {
        var addressValue = $(this).attr("href");
        alert(addressValue);
    });

    function myOptions() {
        var user_option = document.getElementById("sort_option").value;
        switch (user_option) {
            case "name":
                document.getElementById("nameSort").style.display = "inline";
                document.getElementById("ratingSort").style.display = "none";
                break;
            case "rating":
                document.getElementById("nameSort").style.display = "none";
                document.getElementById("ratingSort").style.display = "inline";
                break;
        }
    }

    function newSection(id) {
        document.getElementById("bt-comment").style.display = "none";
        document.getElementById("user-comment").style.display = "block";
        window.location.href = "#comment-box-show/" + id;
        document.getElementById("username").focus();
    }

    // Insert commetst

    function ajax_posts() {
        var username = document.getElementById("username").value;
        var cmt = document.getElementById("review-text").value;
        var rate = document.getElementById("rate-value").value;
        var email = document.getElementById("email").value;

        var key_length = document.getElementById("user-password").value.length;
        if (key_length != 4) {
            alert("length must be 4 password ");
            return false;
        }

        let bird = birdId;

        var s_user_key = document.getElementById("user-password").value;

        $.ajax({
            url: baseUrl + "api/review/insert",
            type: "post",
            data: {
                'reviewer_name': username,
                'viewer_key': s_user_key,
                'review': cmt,
                'rating': rate,
                'birds_id' : birdId,
                'email' : email
            },
            success : function (response) {
            
                return detail(bird, true);
                response = JSON.parse( response );
                alert( response.message );
                var html = '';
                html += '<div class="user-rac-rate" id="2">';
                html += '<p>Username = <strong class="username">' + username + '</strong> &nbsp;&nbsp;&nbsp;&nbsp;Rating = <strong class="rate">' + rate + '</strong>&nbsp;&nbsp;&nbsp;&nbsp;Viewer Mail = <strong>' + email + '</strong>&nbsp;&nbsp;&nbsp;&nbsp;Comment post date = <strong class="comment">' + Date() + '</strong>';
                html += '<select '
                html += 'data-id="' + response.id + '"';
                html += ' onchange="changeOption(this,' + response.id + ','+response.birds_id+')">';
                html += '<option value="null">Select</option>';
                html += '<option value="update">Update</option>';
                html += '<option value="delete">Delete</option>';
                html += '</select>';
                html += '</p><p>';
                html += cmt;
                html += '</p></div>';


                document.getElementById("user-comment").style.display = "none";
                document.getElementById("bt-comment").style.display = "block";
                $("#review-wrapper-div").append( html);
               

            }
        });

    }

    function hideBox() {
        document.getElementById("user-comment").style.display = "none";
        document.getElementById("mg-section").style.textAlign = "center";
        document.getElementById("bt-comment").style.display = "block";
        

        $.ajax({
            url: api_url,
            success: function (result) {

                window.location.href = "http://localhost/Birds/#detail-link";
                $(".main-item").html();
            }
        });

    }
    function changeOption(obj, id, bird_id = "") {
        var option = obj.value,
            $this = $(this),
            reviewId = id;
            let username = $(obj).closest("div[id='rac-"+id+"']").find("strong").eq(0).text();
            let rating = $(obj).closest("div[id='rac-"+id+"']").find("strong").eq(1).text();
            let comment = $(obj).closest("div[id='rac-"+id+"']").find("p").eq(1).text();

        switch (option) {

            case "update":

                document.getElementById("bt-comment").style.display = "none";
                document.getElementById("user-comment").style.display = "none";
                var update = ' ';
                update += '<p>Username = <input type="text" id="update-username" value="'+username+'">';
                update += '&nbsp;&nbsp;&nbsp;&nbsp;Rating';
                update += '<input type="number" min="1" max="5" id="update-rate" value="'+rating+'" >';
                update += '&nbsp; &nbsp;<input type="number" id="update-key" placeholder="your key"  style="width:105px;">';
                update += '<input type="submit" onclick="final_update('+bird_id+')" value="update" >';
                update += '<input type="button" onclick="hideUpdate()" value="Cancel"></p>';
                update += '<p><textarea  id="update-text" cols="30" rows="10">'+comment+'</textarea> </p>';

                document.getElementById("update-rac").style.display = "block";
                $("#update-rac").html(update);
                break;

            case "delete":
                var txt;
                var r = confirm("Are u sure want to delete this review ?");
                if (r == true) {

                    document.getElementById("update-rac").style.display = "none";
                    var user_key = prompt("Enter your key", "Your key");
                    if (!isNaN(user_key) && !(user_key == null) && ( user_key.length == 4)) {


                        $.ajax({
                            url: baseUrl + "api/review/" + user_key,
                            type: "delete",

                            success: function (response) {
                                alert("Successfully Deleted ! ");
                                $("#rac-"+reviewId).remove();
                            }
                        });

                    } else {
                        alert("string, null, less less than or greater that 4 length number can't be accepted !");
                        return false;
                    }

                } else {
                    txt = "Comments not deleted !";
                    alert(txt);
                    document.getElementById("bt-comment").style.display = "block";
                    document.getElementById("update-rac").style.display = "none";
                    break;
                }
                document.getElementById("demo").innerHTML = txt;

                break;
            case "null" :
                document.getElementById("update-rac").style.display = "none";
                document.getElementById("user-comment").style.display = "none";
                document.getElementById("bt-comment").style.display = "block";
                break;
            default:
                break;
        }

    }

    // Update function 
    function final_update(id) {
        let Id = id;
        var update_name = document.getElementById("update-username").value;
        var update_rate = document.getElementById("update-rate").value;
        var update_text = document.getElementById("update-text").value;
        var update_userkey = document.getElementById("update-key").value;

        $.ajax({
            url: baseUrl + "api/review/update",
            type: "put",
            data: {
                update_name: update_name,
                update_rate: update_rate,
                update_text: update_text,
                update_userkey: update_userkey,
                update_review_id : reviewId
            },
            success: function (response) {
                $("#update-rac").html("").hide();
               detail(Id, true);

            }
        });

    }

    function hideUpdate() {
        document.getElementById("bt-comment").style.display = "block";
        document.getElementById("update-rac").style.display = "none";
    }
</script>

</body>
</html>

