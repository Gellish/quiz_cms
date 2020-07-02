<!-- Summary result start -->
<div class="panelbody">
    <div class="Sub_name_time">
        <h2><?php echo display('result_summarized')?></h2>
        <a href="#">
            <span class="detailsIcon"><?php echo display('view_result_summary')?>  <i class="fa fa-arrow-up" aria-hidden="true"></i></span>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table chapter">
            <tbody>
                <tr>
                    <td><div class="chapter-title"><?php echo display('course_name')?></div></td>
                    <td>{course_name}</td>
                    <td>
                        <div class="chapter-title"><?php echo display('no_of_question')?></div>
                    </td>
                    <td>{no_of_question}</td>
                </tr>
                <tr>
                    <td><div class="chapter-title"><?php echo display('chapter_name')?></div></td>
                    <td style="width: 200px;">
                    <?php 
                    $i=1;
                    foreach ($chapters_name as $chapter) {
                        echo strip_tags($i.".".$chapter['chapter_name'].". ");
                    $i++;
                    } ?>
                    </td>
                    <td><div class="chapter-title"><?php echo display('answer_questions')?></div></td>
                    <td>{total_answered}</td>

                </tr>
                <tr>
                    <td><div class="chapter-title"><?php echo display('correct_answer')?></div></td>
                    <td>{correct_answer}</td>
                    <td><div class="chapter-title"><?php echo display('incorrect_answer')?></div></td>
                    <td>{incorrect_answer}</td>
                </tr>
                <tr>
                    <td><div class="chapter-title"><?php echo display('score')?></div></td>
                    <td>{correct_answer} of {no_of_question}</td>
                    <td><div class="chapter-title"><?php echo display('precentage')?></div></td>
                    <td>{result} %</td>
                </tr>
                <tr>
                    <td><div class="chapter-title"><?php echo display('total_time')?></div></td>
                    <td>{time_expense}</td>
                    <td><div class="chapter-title"></div></td>
                    <td class=""></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Summary result end -->