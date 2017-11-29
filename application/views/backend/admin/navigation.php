<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->




        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        <!-- CONFIGURATION -->
          <li class="<?php if ($page_name == 'student_add')  echo 'opened active has-sub'; ?> ">
            <a href="#">
               <i class="fa fa-cogs"></i>
                <span><?php echo get_phrase('configuration'); ?></span>
            </a>
            <ul>
                <!-- DOCUMENT CATEGORIES -->
                <li class="<?php if ($page_name == 'document_categories') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/document_categories">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('document_categories'); ?></span>
                    </a>
                </li>
             </ul>
        </li>
        <!-- HR/PAYROLL -->
        <li class="<?php if( $page_name == 'add_user_type' ||
                             $page_name == 'add_department' ||
                             $page_name == 'add_designation' ||
                             $page_name == 'add_employee' ||
                             $page_name == 'employee_list' ||
                             $page_name == 'add_bank_details' ||
                             $page_name == 'payhead' ||
                             $page_name == 'paytype' ||
                             $page_name == 'salary_setting'||
                             $page_name == 'employee_salary' ||
                             $page_name == 'leave_category' ||
                             $page_name == 'leave_details' ||
                             $page_name == 'leave_application' ||
                             $page_name == 'leave_approval') echo 'opened active has-sub'; ?>">
            <a href="#">
                <i class="fa fa-eye"></i>
                <span><?php echo get_phrase('HR_/_payroll'); ?></span>
            </a>
            <ul>
            <!--EMPLOYEE MANAGEMENT -->
            <li class="<?php if( $page_name == 'add_user_type' ||
                                 $page_name == 'add_department' ||
                                 $page_name == 'add_designation' ||
                                 $page_name == 'add_employee' ||
                                 $page_name == 'employee_list' ||
                                 $page_name == 'add_bank_details') echo 'opened active has-sub'; ?>">
                <a href="#">
                    <span><i class="entypo-dot"></i><?php echo get_phrase('employee_management'); ?></span>
                </a>
                <ul>
                    <li class="<?php if($page_name == 'add_user_type') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/usertype">
                            <span><?php echo get_phrase('add_user_type'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'add_department') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/department">
                            <span><?php echo get_phrase('add_department'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'add_designation') echo 'active';?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/designation">
                            <span><?php echo get_phrase('add_designation'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'add_employee') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/employee">
                            <span><?php echo get_phrase('add_employee'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'employee_list') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/employee/list">
                            <span><?php echo get_phrase('employee_list'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'add_bank_details') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/bank">
                            <span><?php echo get_phrase('add_bank_details'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- PAYROLL -->
            <li class="<?php if($page_name == 'payhead' ||
                                $page_name == 'paytype' ||
                                $page_name == 'salary_setting' ||
                                $page_name == 'employee_salary') echo 'opened active has-sub'?>">
                <a href="#">
                    <span><i class="entypo-dot"></i><?php echo get_phrase('payroll'); ?></span>
                </a>
                <ul>
                    <li class="<?php if($page_name == 'payhead') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/payhead">
                            <span><?php echo get_phrase('pay_head'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'paytype') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/paytype">
                            <span><?php echo get_phrase('payment_types'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'salary_setting') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/salary">
                            <span><?php echo get_phrase('salary_settings'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'employee_salary') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/employee_salary">
                            <span><?php echo get_phrase('employee_salary'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- LEAVE MANAGEMENT -->
            <li class="<?php if($page_name == 'leave_category' ||
                                $page_name == 'leave_details' ||
                                $page_name == 'leave_application' ||
                                $page_name == 'leave_approval') echo 'opened active has-sub'; ?>">
                <a href="#">
                    <span><i class="entypo-dot"></i><?php echo get_phrase('leave_management'); ?></span>
                </a>
                <ul>
                    <li class="<?php if($page_name == 'leave_category') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/leave">
                            <span><?php echo get_phrase('leave_category'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'leave_details') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/leave_detail">
                            <span><?php echo get_phrase('leave_details'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'leave_application') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/leave_application">
                            <span><?php echo get_phrase('leave_application'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if($page_name == 'leave_approval') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/leave_approval">
                            <span><?php echo get_phrase('leave_approvals'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ATTENDANCE -->
            <li class="<?php ?>">
                <a href="#">
                    <span><i class="entypo-dot"></i><?php echo get_phrase('attendance'); ?></span>
                </a>
            </li>
            </ul>
        </li>

        <!-- STUDENT -->
        <li class="<?php if ($page_name == 'student_add' ||
                                $page_name == 'student_bulk_add' ||
                                    $page_name == 'student_information' ||
                                        $page_name == 'student_marksheet' ||
                                        $page_name == 'reset_login' ||
                                        $page_name == 'reset_password' ||
                                            $page_name == 'student_promotion')
                                                echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('student'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'student_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_bulk_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_bulk_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id'] || $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                            <!--<li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">-->
                                <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- STUDENT PROMOTION -->
                <li class="<?php if ($page_name == 'student_promotion') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_promotion">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_promotion'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'reset_login') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/reset_login">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('reset_login'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'reset_password') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/reset_password">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('reset_password'); ?></span>
                    </a>
                </li>

            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/teacher">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>

        <!-- PARENTS -->
        <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/parent">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('parents'); ?></span>
            </a>
        </li>

        <!-- LIBRARIAN -->
        <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/librarian">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('librarian'); ?></span>
            </a>
        </li>

        <!-- ACCOUNTANT -->
        <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/accountant">
                <i class="entypo-briefcase"></i>
                <span><?php echo get_phrase('accountant'); ?></span>
            </a>
        </li>

        <!-- CLASS -->
        <li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section' ||
                    $page_name == 'academic_syllabus')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('class'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/classes">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_classes'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/section">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_sections'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/academic_syllabus">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('academic_syllabus'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/subject/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine_view' ||
                                $page_name == 'class_routine_add')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'class_routine_view' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/class_routine_view/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance' ||
                                $page_name == 'manage_attendance_view' || $page_name == 'attendance_report' || $page_name == 'attendance_report_view')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>
            <ul>

                    <li class="<?php if (($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view')) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/manage_attendance">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('daily_atendance'); ?></span>
                        </a>
                    </li>

            </ul>
            <ul>

                    <li class="<?php if (( $page_name == 'attendance_report' || $page_name == 'attendance_report_view')) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/attendance_report">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('attendance_report'); ?></span>
                        </a>
                    </li>

            </ul>
        </li>


        <!-- EXAMS -->
        <li class="<?php
        if ($page_name == 'exam' ||
                $page_name == 'grade' ||
                $page_name == 'marks_manage' ||
                    $page_name == 'exam_marks_sms' ||
                        $page_name == 'tabulation_sheet' ||
                            $page_name == 'marks_manage_view' || $page_name == 'question_paper')
                                echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'exam') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/exam">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/grade">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_grades'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'marks_manage' || $page_name == 'marks_manage_view') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/marks_manage">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'exam_marks_sms') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/exam_marks_sms">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('send_marks_by_sms'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/tabulation_sheet">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('tabulation_sheet'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'question_paper') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/question_paper">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('question_paper'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- PAYMENT -->
        <!-- <li class="<?php //if ($page_name == 'invoice') echo 'active'; ?> ">
            <a href="<?php //echo base_url(); ?>index.php?admin/invoice">
                <i class="entypo-credit-card"></i>
                <span><?php //echo get_phrase('payment'); ?></span>
            </a>
        </li> -->

        <!-- ACCOUNTING -->
        <li class="<?php
        if ($page_name == 'income' ||
                $page_name == 'expense' ||
                    $page_name == 'expense_category' ||
                        $page_name == 'student_payment')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('accounting'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_payment">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('create_student_payment'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/income">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_payments'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/expense">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/expense_category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expense_category'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/book">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
        </li>

        <!-- TRANSPORT -->
        <li class="<?php if ($page_name == 'transport_vehicle' ||
                                $page_name == 'transport_driver' ||
                                $page_name == 'transport_route' ||
                                $page_name == 'transport_fare' ||
                                $page_name == 'transport_destination' ||
                                $page_name == 'transport_allocation' ||
                                $page_name == 'transport_fee_collection' ||
                                $page_name == 'transport_import' ||
                                $page_name == 'transport_alert') echo 'opened active has-sub'; ?> ">
            <a>
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'transport_vehicle') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/vehicle">
                        <?php echo get_phrase('add_vehicle'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'transport_driver') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/driver">
                        <?php echo get_phrase('add_driver'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'transport_route') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/route">
                        <?php echo get_phrase('add_route'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'transport_fare') echo 'active'; ?>">
                  <a href="<?php echo base_url(); ?>index.php?admin/fare">
                    <?php echo get_phrase('add_fare'); ?>
                  </a>
                </li>
                <li class="<?php if ($page_name == 'transport_destination') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/destination">
                        <?php echo get_phrase('add_destination'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'transport_allocation') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/transport_allocation">
                        <?php echo get_phrase('transport_allocation'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'transport_fee_collection') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/fee_collection">
                        <?php echo get_phrase('fee_collection'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'transport_import') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/transport_import">
                        <?php echo get_phrase('import'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'transport_alert') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/transport_alert">
                        <?php echo get_phrase('SMS_alert'); ?>
                    </a>
                </li>
            </ul>
        </li>

        <!-- DORMITORY -->
        <li class="<?php if ($page_name == 'dormitory_details' ||
                              $page_name == 'dormitory_room') echo 'opened active has-sub'; ?> ">
            <a href="#">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('dormitory'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'dormitory_details') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/details">
                        <?php echo get_phrase('hostel_details'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_room') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/rooms">
                        <?php echo get_phrase('hostel_room'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_hostel_allocation') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/dormitory_hostel_allocation">
                        <?php echo get_phrase('hostel_allocation'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_request_details') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/dormitory_request_details">
                        <?php echo get_phrase('request_details'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_hostel_transfer') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/dormitory_hostel_transfer">
                        <?php echo get_phrase('hostel_transfer_/_vacate'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_hostel_register') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/dormitory_hostel_register">
                        <?php echo get_phrase('hostel_register'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_hostel_visitors') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/dormitory_hostel_visitors">
                        <?php echo get_phrase('hostel_visitors'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_fee_collection') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/dormitory_fee_collection">
                        <?php echo get_phrase('hostel_fee_collection'); ?>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'dormitory_reports') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/dormitory_reports">
                        <?php echo get_phrase('reports'); ?>
                    </a>
                </li>
            </ul>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>
        <!-- TASK MANGER -->
        <li class="<?php if($page_name == 'task_assign' || $page_name == 'task_details') echo 'opened active'; ?>">
            <a href="#">
                <i class="fa fa-tasks"></i>
                <span><?php echo get_phrase('task_manager'); ?></span>
            </a>
            <ul>
                <li class="<?php if($page_name == 'task_assign') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/taskassign">
                        <span><?php echo get_phrase('assign_task'); ?></span>
                    </a>
                </li>
                <li class="<?php if($page_name == 'task_details') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/taskdetails">
                        <span><?php echo get_phrase('task_details'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- MESSAGE -->
         <li class="<?php
            if ($page_name == 'message' ||
                    $page_name == 'whatsappmessage')
                            echo 'opened active';
            ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/message">
                    <i class="entypo-mail"></i>
                    <span><?php echo get_phrase('Messaging'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/message">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('message'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'whatsappmessage') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/getmultipleWhatsappMessage">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('Whatsapp Message'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'WhatsAppMessageHistory') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/getSentHistory">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('Whatsapp Message History'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'MessageTemplate') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/getTemplate">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('Message Template'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Grouping -->
        <li class="<?php if ($page_name == 'grouping') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/getgrouping">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('grouping'); ?></span>
            </a>
        </li>
        <!-- Examination -->
        <li class="<?php if ($page_name == 'examination') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/examination">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('Examination Portal'); ?></span>
            </a>
        </li>
        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                    $page_name == 'sms_settings')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/sms_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
