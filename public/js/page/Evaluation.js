'use strict';

let page = {
    init: () => {
        //
    }
};

page.init();

$(function () {
    let local = {
        init: () => {
            //
        }
    };
    local.init();
    /*======================================================================
    .* CONSTANTS
    .*======================================================================*/

    /*======================================================================
    .* OTHER VARIABLES
    .*======================================================================*/
    var programmingLangauge = $('#programmingLangauge');
    var cardTable = $('#cardTable');
    var totalScore = 0;
    /*======================================================================
    .* METHODS
    .*======================================================================*/

    /*======================================================================
    .* DOM EVENTS
    .*======================================================================*/

    getProgrammingLanguange();

    $(document).on('change', '#slt_language', function () {
        getData($(this).val());
    });

    $(document).on('change', '#card-body-container select', function () {
        const selectedScore = parseInt($(this).val());
        totalScore -= parseInt($(this).data('selected-score')) || 0;
        totalScore += selectedScore;
        $(this).data('selected-score', selectedScore);
        $('#total_score').text(totalScore);
    });

    $(document).on('click', '.saveData', function () {
        alert("Save in Database");
    });

    function getProgrammingLanguange() {
        $.ajax({
            type: 'GET',
            url: fetchProgrammingLanguage,
            success: function (data) {
                var rowHtml = `
                    <label for="">Programming Language</label><br>
                    <select name="programming_language" id="slt_language" class="form-control">
                        <option value="" disabled selected>Select Programming Language</option>`;
                for (var i = 0; i < data.length; i++) {
                    rowHtml += `
                        <option value="${data[i].id}">${data[i].language_name}</option>`;
                }
                rowHtml += `
                    </select>
                `;
                programmingLangauge.html(rowHtml);
            },
            error: function () {
                console.log('Error');
            }
        });
    }

    function getData(levelItemId) {
        $.ajax({
            type: 'GET',
            url: fetchLevelItem.replace(':id', levelItemId),
            success: function (leveldata) {
                if (leveldata.levels.length == 0) return;
                var levels = leveldata.levels;
                var rowHtml = '';
                for (var i = 0; i < levels.length; i++) {
                    var criterias = leveldata.levels[i].criterias;
                    if (criterias.length == 0) break;
                    rowHtml += `
                        <div class="card mt-2"> 
                            <div class="card-body">
                                <table class="table table-bordered text-center mb-5">
                                    <tr>
                                        <td colspan="5">${levels[i].item_name}</td>
                                    </tr>`;
                    for (var l = 0; l < criterias.length; l++) {
                        var sub_criterias = leveldata.levels[i].criterias[l].sub_criterias;
                        if (sub_criterias.length > 0) {
                            if (levels[i].id == criterias[l].programming_level_item_id) {
                                rowHtml += `
                                    <tr>
                                        <td colspan="5">${criterias[l].criteria_description}</td>
                                    </tr>`;
                                rowHtml += `
                                    <tr>
                                        <td colspan="2">CRITERIA</td>
                                        <td style="width: 20%;">Comments</td>
                                        <td style="width: 20%;" rowspan="${1 + (leveldata.levels[i].criterias[l]?.sub_criterias?.length || 0)}">
                                            Comments<br>
                                            <textarea class="form-control mt-4" name="criteria_remarks" rows="${2 * (leveldata.levels[i].criterias[l]?.sub_criterias?.length || 0)}"></textarea>
                                        </td>
                                        <td rowspan="${1 + (leveldata.levels[i].criterias[l]?.sub_criterias?.length || 0)}" style="width: 10%; vertical-align: middle;">
                                           <span id="initial_score${l}">0</span>
                                        </td>
                                    </tr>`;
                            }
                            for (var j = 0; j < sub_criterias.length; j++) {
                                if (criterias[l].id == sub_criterias[j].programming_level_item_criteria_id) {
                                    rowHtml += `
                                    <tr>
                                        <td style="width: 10%;" style="vertical-align: middle;">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input level${i}_criteria${l}_subCriteria${j}" name="level${i}_criteria${l}_subCriteria${j}" value="Yes">Yes
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input level${i}_criteria${l}_subCriteria${j}" name="level${i}_criteria${l}_subCriteria${j}" value="No">No
                                                </label>
                                            </div>
                                        </td>
                                        <td>${sub_criterias[j].criteria_description}</td>
                                        <td><input type="text" name="subCriteria_remarks" class="form-control"></td>
                                    </tr>`;
                                }
                            }
                        }

                    }
                    rowHtml += `
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Sub Total</td>
                                    <td><span id="subtotal${i}"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Max. Marks</td>
                                    <td>${levels[i].total_score}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    `;
                }
                rowHtml += `
                    <div id="professional_criteria">
                    </div>
                        <button class="btn btn-info float-right mb-5 saveData">Submit</button>
                   `;
                cardTable.html(rowHtml);
                getRating();
                cardTable.on("click", "input[type='radio']", function () {
                    var radioValue = $(this).val();
                    if (criterias.length === 0) return;

                    for (var i = 0; i < levels.length; i++) {
                        var formattedScore = levels[i].total_score / criterias.length;
                        for (var l = 0; l < criterias.length; l++) {
                            for (var j = 0; j < sub_criterias.length; j++) {
                                var className = "level" + i + "_criteria" + l + "_subCriteria" + j;

                                if ($(this).hasClass(className)) {
                                    var dynamicVariableName = "initialScore" + l;

                                    if (typeof window[dynamicVariableName] === "undefined") {
                                        window[dynamicVariableName] = 0;
                                    }

                                    if (radioValue === "Yes") {
                                        window[dynamicVariableName] += 1;
                                        $("." + className).addClass("Yes");
                                    } else if (radioValue === "No") {
                                        if ($(this).hasClass("Yes")) {
                                            window[dynamicVariableName] -= 1;
                                            window[dynamicVariableName] = Math.max(0, window[dynamicVariableName]);
                                            $("." + className).removeClass("Yes");
                                        }
                                    }

                                    $('#initial_score' + l).text((formattedScore / sub_criterias.length) * window[dynamicVariableName]);
                                }
                            }
                        }
                    }
                });






            },
            error: function () {
                console.log('Error');
            }
        });
    }

    function getRating() {
        var professional_criteria = $('#professional_criteria');
        $.ajax({
            type: 'GET',
            url: fetchRating,
            success: function (data) {
                var rowHtml = '';
                if (data.ratings.length == 0) return;
                rowHtml += `
                    <div class="card mt-2">
                        <div class="card-body">
                            <fieldset class="border p-2">
                                <legend class="w-auto">Ratings Legend</legend>
                                <div class="d-flex">`;
                for (var i = 0; i < data.ratings.length; i++) {
                    rowHtml += `
                        <p class="mx-2">${data.ratings[i].description} = ${data.ratings[i].score}</p>`;
                }
                rowHtml += `
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    `;
                rowHtml += `
                <div class="card mt-2">
                    <div class="card-header">
                        Professional Development
                    </div>
                    <div class="card-body" id="card-body-container">`;
                for (var j = 0; j < data.criteria.length; j++) {
                    rowHtml += `
                        <div class="row mb-3">
                            <div class="col-7">
                                <p>${data.criteria[j].criteria_description}</p>
                            </div>
                            <div class="col-2">
                                <select name="" class="form-control" id="">
                                    <option value="" disabled selected>Select Rating</option>`;

                    for (var l = 0; l < data.ratings.length; l++) {

                        rowHtml += `
                                    <option value="${data.ratings[l].score}">${data.ratings[l].description}</option>
                                    `;
                    }
                    rowHtml += `
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="remarks[]">
                            </div>
                        </div>`
                }
                rowHtml += `
                    <div class="float-right mt-5">
                        <b><p>Total Score: <span class="mx-5" id="total_score">0</span></p></b>
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        RECOMMENDATION AND FINAL COMMENTS
                    </div>
                    <div class="card-body">
                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>     
                `;
                professional_criteria.html(rowHtml);
            },
            error: function () {
                console.log('Error');
            }
        });
    }
});
