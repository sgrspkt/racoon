<?php
include("includes/header.php");
include ("api/index.php");
$result = json_decode($response,true);


?>


<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<div class="detail-container">
   <div class="sum-list">
        <p><strong>Detail</strong> of Raccoon Name</p>
   </div>
   <section class="rac-detail">
            <img src="assets/images/Curious_Raccoon.jpg" alt="">

        <div class="about-rac">
           <p><big><strong>Description </strong></big> </p>
            <p>Name              <strong> = Hello</strong> </p>
            <p>Total Review      <strong> = 45</strong> </p>
            <p>Average Rating    <strong> = 4</strong> </p>
        </div>

    </section>
    <section class="user-review">
        <div class="user-comments">
            <p>User Reviews</p>
        </div>
        <div class="user-rac-rate" id="1">
            <p>Username = <strong>Rabin Bhandari</strong> &nbsp;&nbsp;&nbsp;&nbsp;Rating = <strong>4</strong>
            <select  onchange="changeOption(this)">
                <option value="null">Select Option</option>
                <option value="update">Update</option>
                <option value="delete">Delete</option>
            </select>
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique aperiam quisquam quibusdam commodi dicta tempore, fugiat. Nobis possimus unde id, fuga, mollitia officiis! Neque labore eum, libero adipisci eligendi vel nostrum iusto in, minima quas ipsa necessitatibus odio, natus deleniti aliquid assumenda facere aut, sequi dolor tempora omnis illum. Rerum eaque, odio!</p>
        </div>

        <div class="user-rac-rate" id="2">
            <p>Username = <strong>Rabinss Bhandari</strong> &nbsp;&nbsp;&nbsp;&nbsp;Rating = <strong>4</strong>
            <select  onchange="changeOption(this)">
                <option value="null">Select Option</option>
                <option value="update">Update</option>
                <option value="delete">Delete</option>
            </select>
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique aperiam quisquam quibusdam commodi dicta tempore, fugiat. Nobis possimus unde id, fuga, mollitia officiis! Neque labore eum, libero adipisci eligendi vel nostrum iusto in, minima quas ipsa necessitatibus odio, natus deleniti aliquid assumenda facere aut, sequi dolor tempora omnis illum. Rerum eaque, odio!</p>
        </div>

        <div class="user-rac-rate" id="3">
            <p>Username = <strong>RabinGaurab Bhandari</strong> &nbsp;&nbsp;&nbsp;&nbsp;Rating = <strong>4</strong>
            <select  onchange="changeOption(this)">
                <option value="null">Select Option</option>
                <option value="update">Update</option>
                <option value="delete">Delete</option>
            </select>
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique aperiam quisquam quibusdam commodi dicta tempore, fugiat. Nobis possimus unde id, fuga, mollitia officiis! Neque labore eum, libero adipisci eligendi vel nostrum iusto in, minima quas ipsa necessitatibus odio, natus deleniti aliquid assumenda facere aut, sequi dolor tempora omnis illum. Rerum eaque, odio!</p>
        </div>
        <div class="user-rac-rate" id="4">
            <p>Username = <strong>Rabin Bhandari</strong> &nbsp;&nbsp;&nbsp;&nbsp;Rating = <strong>4</strong>
            <select  onchange="changeOption(this)">
                <option value="null">Select Option</option>
                <option value="update">Update</option>
                <option value="delete">Delete</option>
            </select>
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique aperiam quisquam quibusdam commodi dicta tempore, fugiat. Nobis possimus unde id, fuga, mollitia officiis! Neque labore eum, libero adipisci eligendi vel nostrum iusto in, minima quas ipsa necessitatibus odio, natus deleniti aliquid assumenda facere aut, sequi dolor tempora omnis illum. Rerum eaque, odio!</p>
        </div>
         <div class="user-rac-rate" id="update-rac">
            <form action="api/api/">
                <p>Username = <input type="text" value="rabin"> &nbsp;&nbsp;&nbsp;&nbsp;Rating  <input type="number" min="1" max="5" value="4" >
                <input type="submit" value="update" >
                <input type="button" onclick="hideUpdate()" value="Cancel">
                </p>
                <p> <textarea name="" id="" cols="30" rows="10"></textarea> </p>
                <input name="method" type="hidden" value="put" >
            </form>
        </div>

    </section>
    <div class="new-review-button" id="mg-section">
        <button onclick="newSection()" id="bt-comment" >Click here to add your new Review</button>
        <div class="user-comment" id="user-comment">
            <form action="api/api" method="post">
                <input type="text" name="username" id="username" placeholder="Your name" required>
                <span>Your Rating &nbsp;&nbsp;&nbsp; </span>
                
                <span class="radio-toolbar">
                    <input type="radio" id="rate1" name="rate" value="1">
                    <label for="rate1">1</label>
                    <input type="radio" id="rate2" name="rate" value="2">
                    <label for="rate2">2</label>
                    <input type="radio" id="rate3" name="rate" value="3">
                    <label for="rate3">3</label>
                    <input type="radio" id="rate4" name="rate" value="4">
                    <label for="rate4">4</label>
                    <input type="radio" id="rate5" name="rate" value="5">
                    <label for="rate5">5</label>
                </span>

                <p>
                <textarea name="" id="" cols="30" rows="10">Hello</textarea>
                </p>
                <div class="button-area" id="comment-box-show">
                    <input type="submit"  value="Post">
                    <input type="button" onclick="hideBox()" id="cancel" value="Cancel">
                </div>

            </form>
        </div>
    </div>
</div>
<script>

    function newSection()
    {
        document.getElementById("bt-comment").style.display = "none";
        document.getElementById("user-comment").style.display = "block";
        window.location.href = "#comment-box-show";
        document.getElementById("username").focus();
    }
    function hideBox()
    {
        document.getElementById("user-comment").style.display = "none";
        document.getElementById("mg-section").style.textAlign = "center";
        document.getElementById("bt-comment").style.display = "block";

    }
    function changeOption(obj)
    {
        var option = obj.value,
            id = obj.getAttribute('data-id');
        switch (option) {
            case "update":
                document.getElementById("bt-comment").style.display = "none";
                document.getElementById("user-comment").style.display = "none";
                document.getElementById("3").style.display = "none";
                document.getElementById("update-rac").style.display = "block";

                break;
            case "delete":
                    var txt;
                    var r = confirm("Are u sure want to delete this review ?");
                    if (r == true) {
                        txt = "You pressed OK!";
                    } else {
                        txt = "You pressed Cancel!";
                        document.getElementById("bt-comment").style.display = "block";
                        document.getElementById("3").style.display = "block";
                        document.getElementById("update-rac").style.display = "none";
                 break;
                    }
                    document.getElementById("demo").innerHTML = txt;

                break;
            case "null" :
                document.getElementById("3").style.display = "block";
                document.getElementById("update-rac").style.display = "none";
                 break;
            default:
                break;
        }

    }

    function hideUpdate()
    {
        document.getElementById("bt-comment").style.display = "block";
        document.getElementById("3").style.display = "block";
        document.getElementById("update-rac").style.display = "none";
    }

</script>
</body>
</html>