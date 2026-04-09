$(document).ready(function () {
    function loadCourses(search = "") {
        $.ajax({
            url: "ajax/search_courses.php",
            type: "GET",
            data: { search: search },
            success: function (data) {
                $("#course-list").html(data);
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:");
                console.log("Status:", status);
                console.log("Error:", error);
                console.log("Response:", xhr.responseText);

                $("#course-list").html("<p class='text-danger'>Failed to load courses.</p>");
            }
        });
    }

    loadCourses();

    $("#search").on("keyup", function () {
        loadCourses($(this).val());
    });

    $(document).on("click", ".register-course", function () {
        let courseId = $(this).data("id");

        $.post("ajax/register_course.php", { course_id: courseId }, function (response) {
            alert(response);
            loadCourses($("#search").val());
            location.reload();
        });
    });

    $(document).on("click", ".drop-course", function () {
        let courseId = $(this).data("id");

        $.post("ajax/drop_course.php", { course_id: courseId }, function (response) {
            alert(response);
            location.reload();
        });
    });
});