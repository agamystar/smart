<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>


<div class="row">
<div class="form-horizontal "  >
<?php     if($this->session->userdata("groups")=="admin"){
    ?>
    <div class="form-group col-sm-12">
        <span class="col-sm-2" > Select  Class </span>
        <input  class="col-sm-9" id="select_class"  required="true"  value=""/>

    </div>


    <div class="form-group col-sm-12">
            <div class="left col-sm-5 align-left">
                <?php // print_r($subjects);?>
                <table>



                    <?php
                    if(isset($subjects)){
                    foreach($subjects as $one){?>
                    <tr>
                        <td><div class="subject" value="<?php echo $one->subject_id?>"><?php echo $one->name?></div></td>
                    </tr>

                 <?php }
                    }
                        ?>

                </table>
            </div>

            <div class="col-sm-2  ">

                <button class="btn btn-app btn-purple  col-sm-12" id="create_table">
                    <i class="icon-cloud-upload bigger-200"></i>
                    Submit
                </button>
<div class="col-sm-12">

    <input value="0"  type="radio" checked="" name="open_close_day"> open Saturday
    <br/>
    <input value="1"  type="radio" name="open_close_day"> close Saturday

</div>

              </div>

            <div class="left col-sm-5 align-right">
                <table>

                    <?php
                    if(isset($student_teachers)){
                    foreach($student_teachers as $one){?>
                    <tr>
                        <td>
                            <div class=" teacher" value="<?php echo $one->teacher_id?>"><?php echo data_user($one->teacher_id)->name ?> </div>

                        </td>

                        <td> <span class="label label-success arrowed-in arrowed-in-right">
                             <?php echo data_user($one->teacher_id)->job ?>
                         </span>
                        </td>
                    </tr>
                    <?php }
                    }
                        ?>

                </table>
            </div>
            </div>
<?php }?>
    <div class="form-group col-sm-12 right ">
        <table>
            <tr>
                <td class="title ">#</td>
                <td class="title ">session 1</td>
                <td class="title ">session 2</td>
                <td class="title ">session 3</td>
                <td class="title ">session 4</td>
                <td class="title ">session 5</td>
                <td class="title ">session 6</td>
                <td class="title ">session 7</td>


            </tr>
            <tr day="1">
                <td>Saturday </td>
                <td section="1"><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="2"><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="3"><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="4"><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="5"><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="6"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="7"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>

            </tr>

            <tr day="2">
                <td>Sunday </td>
                <td section="1"><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="2"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="3"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="4"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="5"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="6"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="7"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
            </tr>

            <tr day="3">
                <td>Monday </td>
                <td section="1"><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="2"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="3"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td section="4"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="5" ><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="6"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td section="7"><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>

            </tr>

            <tr day="4">
                <td>Tuesday </td>
                <td><div class="drop subj"  type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
            </tr>
            <tr day="5">
                <td >Wednesday </td>
                <td><div class="drop subj"   type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
            </tr>
            <tr day="6">
                <td>Thursday </td>
                <td><div class="drop subj"   type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div>  </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
                <td><div class="drop subj" type="text"></div><div class="drop teach" type="text"></div> </td>
            </tr>
        </table>
    </div>
</div>
<style type="text/css">


    .right table{
        background:#E0ECFF;

    }
    .right td{
        background:#fafafa;
        color:#444;
        text-align:center;
        width:135px;
        height: 70px;

    }
    .right td div{
        width:130px;
        height: 35px;

    }
    .right td{
        background:#E0ECFF;
    }
    .right td.drop{
        background:#fafafa;
    }
    .right td.over{
        background:#FBEC88;
        z-index: 9999
    }
    .subject{
        text-align: center;
        border: 2px dashed #EEE;
        background: none repeat scroll 0% 0% #82AF6F;
        color: #FFF;
        width: 200px;
        height: 30px;

    }
    .teacher{
        text-align:center;
        border:2px dashed #eeeeee;
        background:#fafafa;
        color:#444;
        width:300px;
        float: right;
        height: 30px;

    }
    .assigned{
        border:0px solid #0099FF;
    }
    .trash{
        background-color:#0099FF;
        content: '';
    }
    .drop{
        border: 2px solid #ffff00;
    }

    .right td div.drop:first-child{
        border: 1px solid #008000 !important;
    }
 .right td div.drop:last-child{
        border: 1px solid rgba(183, 164, 164, 1) !important;
    }
    .right td div.subject{
        color: #ffffff;
        background-color: rgba(172, 231, 74, 1);;
    }

    .right td div.teacher{
        color: #000;
        background-color:#eeeeee !important;
    }

</style>

</div>


<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'footer.php');
?>