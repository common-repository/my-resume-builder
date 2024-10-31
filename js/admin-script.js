jQuery(document).ready(function ($) {

  $(document).on("click", ".delete_button", function () {
    $(this).parent().remove();
  });

  let counter = $("#last_index").data("last_index") + 1;
  let skills_counter = $("#last_index_skills").data("last_index") + 1;
  let projects_counter = $("#last_index_projects").data("last_index") + 1;

  const hist_buttons = `
    <div id="hist_buttons_box">
        <p><a href="#" id="add_title_button">Add Section/Title</a></p>
        <p><a href="#" id="add_experience_button">Add Experience/Education</a></p></div>
    </div>
    `;

  $("#history > .sortable").append(hist_buttons);
  $("#add_experience_button").click(function (event) {
    event.preventDefault();
    const exp_box = `
        <div style="position:relative">
            <div class="fields-section">
                <i class="fas fa-bars handle"></i>
                <div class="field-row">
                    <label for="mrb_experience[${counter}][date_range]">Date Range</label>
                    <input type="text" name="mrb_experience[${counter}][date_range]">
                </div>
                <div class="field-row">
                    <label for="mrb_experience[${counter}][position]">Job Role / Field</label>
                    <input type="text" name="mrb_experience[${counter}][position]">
                </div>
                <div class="field-row">
                    <label for="mrb_experience[${counter}][company]">Company / School</label>
                    <input type="text" name="mrb_experience[${counter}][company]">
                </div>
                <div class="field-row">
                    <label for="mrb_experience[${counter}][roles]">Key Roles / Courses</label>
                    <textarea name="mrb_experience[${counter}][roles]" class="ckeditor"></textarea>
                </div>
                <div class="delete_button">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                </div>
            </div>
        </div>
        `;
    $("#hist_buttons_box").before(exp_box);
    CKEDITOR.replace(`mrb_experience[${counter}][roles]`)
    counter += 1;
  });

  $("#add_title_button").click(function (event) {
    event.preventDefault();
    const title_box = `
        <div style="position:relative">
            <div class="fields-section">
                <i class="fas fa-bars handle"></i>
                <label for="mrb_experience[title_${counter}]">Section</label>
                <input type="text" name="mrb_experience[title_${counter}]" placeholder="Ex. Education">
                <div class="delete_button">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                </div>
            </div>
        </div>    
        `;
    $("#hist_buttons_box").before(title_box);
    counter += 1;
  });

  // Creates and add action to the skill add/buttons
  const skills_buttons = `
    <div id="skill_buttons_box">
        <p><a href="#" id="add_skill_title_button">Add Section/Title</a></p>
        <p><a href="#" id="add_skill_button">Add Skill</a></p></div>
    </div>
    `;

  $("#skills > .sortable").append(skills_buttons);
  $("#add_skill_button").click(function (event) {
    event.preventDefault();
    const skill_box = `
        <div style="position: relative;">
            <div class="fields-section">
                <i class="fas fa-bars handle"></i>
                <div class="field-row">
                    <label for="mrb_skills[${skills_counter}][skill_type]">Skill Type</label>
                    <input type="text" name="mrb_skills[${skills_counter}][skill_type]">
                </div>
                <div class="field-row">
                    <label for="mrb_skills[${counter}][description]">Description</label>
                    <textarea name="mrb_skills[${skills_counter}][description]"></textarea>
                </div>    
                <div class="delete_button">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                </div>
            </div>
        </div>
        `;
    $("#skill_buttons_box").before(skill_box);
    CKEDITOR.replace(`mrb_skills[${skills_counter}][description]`)
    skills_counter += 1;
  });

  $("#add_skill_title_button").click(function (event) {
    event.preventDefault();
    const title_box = `
        <div style="position:relative">
            <div class="fields-section">
                <i class="fas fa-bars handle"></i>
                <div class="field-row">
                    <label for="mrb_skills[title_${skills_counter}]">Title</label>
                    <input type="text" name="mrb_skills[title_${skills_counter}]" placeholder="Ex. Web Development">
                </div>
                <div class="delete_button">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                </div>
            </div>
        </div>    
        `;
    $("#skill_buttons_box").before(title_box);
    skills_counter += 1;
  });

  // Creates and add action to the project/section add button
  const projects_buttons = `
    <div id="project_buttons_box">
        <p><a href="#" id="add_project_title_button">Add Section/Title</a></p>
        <p><a href="#" id="add_project_button">Add Project</a></p></div>
    </div>
    `;

  $("#projects > .sortable").append(projects_buttons);
  $("#add_project_button").click(function (event) {
    event.preventDefault();
    const project_box = `
        <div style="position:relative">
            <div class="fields-section">
                <i class="fas fa-bars handle"></i>
                <div class="field-row">
                    <label for="mrb_projects[${projects_counter}][project_type]">Project Name</label>
                    <input type="text" name="mrb_projects[${projects_counter}][project_type]">
                </div>
                <div class="field-row">
                    <label for="mrb_projects[${projects_counter}][description]">Description</label>
                    <textarea name="mrb_projects[${projects_counter}][description]"></textarea>
                </div>
                <div class="delete_button">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                </div>
            </div>
        </div>    
        `;
    $("#project_buttons_box").before(project_box);
    CKEDITOR.replace(`mrb_projects[${projects_counter}][description]`)
    projects_counter += 1;
  });

  $("#add_project_title_button").click(function (event) {
    event.preventDefault();
    const title_box = `
        <div style="position:relative">
            <div class="fields-section">
                <i class="fas fa-bars handle"></i>
                <div class="field-row">
                    <label for="mrb_projects[title_${projects_counter}]">Title</label>
                    <input type="text" name="mrb_projects[title_${projects_counter}]" placeholder="Ex. ITSM implementation for company abc">
                </div>
                <div class="delete_button">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                </div>
            </div>
        </div>    
        `;
    $("#project_buttons_box").before(title_box);
    projects_counter += 1;
  });

  $(".sortable").sortable({
    handle: ".fa-bars",
  });

});
