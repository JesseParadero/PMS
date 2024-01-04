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

    /*======================================================================
    .* METHODS
    .*======================================================================*/

    /*======================================================================
    .* DOM EVENTS
    .*======================================================================*/

    $(document).on('change', '#programming_level_item_id_for_criteria', function () {
        var levelId = $(this).val();
        const selectedCriteriaData = $("#selectedCriteriaData");
        selectedCriteriaData.empty();
        $('#spinner-overlay').show();

        $.ajax({
            type: 'GET',
            url: fetchDescription.replace(':id', levelId),
            success: function (data) {
                var rowHtml = `
                    <div class="form-group" style="margin-left:35px;margin-top:-30px;">
                        <select class="form-control" name="programming_level_item_criteria_id" id="programming_level_item_criteria_id">
                            <option selected disabled>Select Criteria</option>`;

                for (var i = 0; i < data.length; i++) {
                    rowHtml += `
                      <option value="${data[i].id}">${data[i].criteria_description}</option>`;
                }
                rowHtml += `
                          </select>
                          </div>`;
                selectedCriteriaData.html(rowHtml);
                $('#spinner-overlay').hide();
            },
            error: function () {
                console.log('Error');
            }
        });
    });

    $(document).on('change', '#programming_level_item_criteria_id', function () {
        var CriteriaId = $(this).val();
        var selectedCriteriaDataDescription = $("#selectedCriteriaDataDescription");
        selectedCriteriaDataDescription.empty();
        $('#spinner-overlay').show();

        $.ajax({
            type: 'GET',
            url: fetchCriteriaUrl.replace(':id', CriteriaId),
            success: function (data) {
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var rowHtml = `
                            <div class="row">
                                <div class="col-sm-3 col-lg-9">
                                    <label>Criteria Description</label>
                                    <input type="hidden" name="sub_criteria_id[]" value="${data[i].id}">
                                    <input type="text" class="form-control" name="criteria_description[]" value="${data[i].criteria_description}">
                                </div>
                                <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
                                    <button type="button" class="btn btn-primary rounded-circle add-criteria"><i class="fa-solid fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger rounded-circle delete-sub-criteria" data-id="${data[i].id}"><i class="fa-solid fa-x"></i></button>
                                </div>
                            </div>
                        `;
                        selectedCriteriaDataDescription.append(rowHtml);
                    }
                } else {
                    var rowHtml = `
                        <div class="row">
                            <div class="col-sm-3 col-lg-9">
                                <label>Criteria Description</label>
                                <input type="text" class="form-control" name="criteria_description[]">
                            </div>
                            <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
                                <button type="button" class="btn btn-primary rounded-circle add-criteria"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    `;
                    selectedCriteriaDataDescription.append(rowHtml);
                }
                $('#spinner-overlay').hide();
            },
            error: function () {
                console.log('Error');
            }
        });
    });

    const selectedCriteriaDataDescription = $("#selectedCriteriaDataDescription");

    selectedCriteriaDataDescription.on("click", ".add-criteria", function () {
        const newRow = $("<div>").addClass("row").html(`
        <div class="col-sm-3 col-lg-9">
            <label>Criteria Description</label>
            <input type="text" class="form-control" name="criteria_description[]">
        </div>
        <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
            <button type="button" class="btn btn-primary rounded-circle add-criteria"><i class="fa-solid fa-plus"></i></button>
            <button type="button" class="btn btn-danger rounded-circle removeCriteria"><i class="fa-solid fa-x"></i></button>
        </div>
        `);
        selectedCriteriaDataDescription.append(newRow);
    });

    selectedCriteriaDataDescription.on("click", ".removeCriteria", function () {
        const row = $(this).closest(".row");
        if (row.length > 0) {
            row.remove();
        }
    });

    $(document).on('click', '.delete-sub-criteria', function () {
        const rowToDelete = $(this).closest('.row');
        const rowId = $(this).data("id");
        const url = deleteSubCriteriaUrl.replace(':id', rowId);

        $('#spinner-overlay').show();
        rowToDelete.remove();

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _method: 'DELETE',
            },
            success: function (data) {
                location.reload();
                $('#spinner-overlay').hide();
            },
            error: function (error) {
                console.error('Error deleting record', error);
                $('#spinner-overlay').hide();
            }
        });
    });

    $(document).on('change', '#programming_level_item_id', function () {
        var itemId = $(this).val();
        const criteriaContainer = $("#selectedLevelData");
        criteriaContainer.empty();
        $('#spinner-overlay').show();

        $.ajax({
            type: 'GET',
            url: fetchDescription.replace(':id', itemId),
            success: function (data) {
                console.log(data);
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var rowHtml = `
                            <div class="row">
                                <div class="col-sm-3 col-lg-9">
                                    <label>Criteria Description</label>
                                    <input type="hidden" name="criteria_id[]" value="${data[i].id}">
                                    <input type="text" class="form-control" name="criteria_description[]" value="${data[i].criteria_description}">
                                </div>
                                <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
                                    <button type="button" class="btn btn-primary rounded-circle add-criteria"><i class="fa-solid fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger rounded-circle remove-criteria" data-id="${data[i].id}"><i class="fa-solid fa-x"></i></button>
                                </div>
                            </div>
                        `;
                        criteriaContainer.append(rowHtml);
                    }
                } else {
                    var rowHtml = `
                        <div class="row">
                            <div class="col-sm-3 col-lg-9">
                                <label>Criteria Description</label>
                                <input type="text" class="form-control" name="criteria_description[]">
                            </div>
                            <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
                                <button type="button" class="btn btn-primary rounded-circle add-criteria"><i class="fa-solid fa-plus"></i></button>
                                <button type="button" class="btn btn-danger rounded-circle removeCriteria"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    `;
                    criteriaContainer.append(rowHtml);
                }
                $('#spinner-overlay').hide();
            },
            error: function () {
                var rowHtml = `
                        <div class="row">
                            <div class="col-sm-3 col-lg-9">
                                <label>Criteria Description</label>
                                <input type="text" class="form-control" name="criteria_description[]">
                            </div>
                            <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
                                <button type="button" class="btn btn-primary rounded-circle add-criteria"><i class="fa-solid fa-plus"></i></button>
                                <button type="button" class="btn btn-danger rounded-circle removeCriteria"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    `;
                criteriaContainer.append(rowHtml);
            }
        });
    });

    const criteriaContainer = $("#selectedLevelData");

    criteriaContainer.on("click", ".add-criteria", function () {
        const newRow = $("<div>").addClass("row").html(`
        <div class="col-sm-3 col-lg-9">
            <label>Criteria Description</label>
            <input type="text" class="form-control" name="criteria_description[]">
        </div>
        <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
            <button type="button" class="btn btn-primary rounded-circle add-criteria"><i class="fa-solid fa-plus"></i></button>
            <button type="button" class="btn btn-danger rounded-circle removeCriteria"><i class="fa-solid fa-x"></i></button>
        </div>
        `);
        criteriaContainer.append(newRow);
    });

    criteriaContainer.on("click", ".removeCriteria", function () {
        const row = $(this).closest(".row");
        if (row.length > 0) {
            row.remove();
        }
    });

    $(document).on('click', '.remove-criteria', function () {
        const rowToDelete = $(this).closest('.row');
        const rowId = $(this).data("id");
        const url = deleteCriteriaUrl.replace(':id', rowId);

        $('#spinner-overlay').show();
        rowToDelete.remove();

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _method: 'DELETE',
            },
            success: function (data) {
                location.reload();
                $('#spinner-overlay').hide();
            },
            error: function (error) {
                console.error('Error deleting record', error);
                $('#spinner-overlay').hide();
            }
        });
    });

    // Level Items

    const levelContainer = $("#level-container");

    levelContainer.on("click", ".addLevel", function () {
        const newRow = $("<div>").addClass("row").html(`
            <div class="col-sm-3 col-lg-5">
                <label>Item Name</label>
                <input type="text" class="form-control" name="item_name[]">
            </div>
            <div class="col-sm-3 col-lg-2">
                <label>Rank Number</label>
                <input type="number" class="form-control" name="rank_number[]">
            </div>
            <div class="col-sm-3 col-lg-2">
                <label>Total Score</label>
                <input type="number" class="form-control" name="total_score[]">
            </div>
            <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
                <button type=button class="btn btn-primary rounded-circle addLevel"><i class="fa-solid fa-plus"></i></button>
                <button type=button class="btn btn-danger rounded-circle remove"><i class="fa-solid fa-x"></i></button>
            </div>
        `);
        levelContainer.append(newRow);
    });

    levelContainer.on("click", ".remove", function () {
        const row = $(this).closest(".row");
        if (row.length > 0) {
            row.remove();
        }
    });

    $(".deleteButtonLevel").click(function () {
        const rowToDelete = $(this).closest('.row');
        const rowId = $(this).data("id");
        const url = deleteUrl.replace(':id', rowId);

        $('#spinner-overlay').show();
        rowToDelete.remove();

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _method: 'DELETE',
            },
            success: function (data) {
                location.reload();
                $('#spinner-overlay').hide();
            },
            error: function (error) {
                console.error('Error deleting record', error);
                $('#spinner-overlay').hide();
            }
        });
    });


});
