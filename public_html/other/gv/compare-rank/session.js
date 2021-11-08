var sortingArrays = [];
var currentSortingArrayIndex = 0;
var sortedEntriesIds = [];

function startSorting() {
    sortingArrays[currentSortingArrayIndex] = { "array": [...Array(entries.length).keys()] };
    nextSorting();
}

function nextSorting(k = 5, addPivot = false) {
    clearContent();
    if (addPivot) k--;
    let newArray = sortingArrays[currentSortingArrayIndex]["array"].slice(0, k);
    if (addPivot) newArray = [sortingArrays[currentSortingArrayIndex]["pivot"]].concat(newArray);
    if (newArray.length == 0) {
        nextSortingLevel();
        return;
    }
    fill(newArray);
    sortingArrays[currentSortingArrayIndex]["array"] = sortingArrays[currentSortingArrayIndex]["array"].slice(k);
}

function nextSortingLevel() {
    let side = sortingArrays[currentSortingArrayIndex]["parentSide"];
    if (side == "l") {
        currentSortingArrayIndex = currentSortingArrayIndex + 1;
        nextSorting();
    } else if (side == "r") {
        if (currentSortingArrayIndex == 0) endSorting();
        else {
            currentSortingArrayIndex = sortingArrays[currentSortingArrayIndex]["parentNo"]
            nextSorting();
        }
    }
}

function endSorting() {
    console.log("Finished!");
    //console.log("Sorted entries ids: " + sortingArrays[0]["lArray"].concat(sortingArrays[0]["pivot"]).concat(sortingArrays[0]["rArray"]));
}

function submitSort() {
    let currentSortingArray = sortingArrays[currentSortingArrayIndex];
    let sortingLArray = currentSortingArray["lArray"];
    let sortingRArray = currentSortingArray["rArray"];
    let sortingPivot = currentSortingArray["pivot"];
    let sortingParentNo = currentSortingArray["parentNo"];
    let sortingParentSide = currentSortingArray["parentSide"];

    let sortedArray = readSorted();
    console.log("Sorting Arrays:");
    console.log(sortingArrays)
    console.log("Sorted Entries Ids:");
    console.log(sortedEntriesIds)

    if (sortingLArray == undefined) sortingLArray = [];
    if (sortingRArray == undefined) sortingRArray = [];
    if (currentSortingArray["array"].length == 0 && sortingLArray.length == 0 && sortingRArray.length == 0 && sortingPivot == undefined) {
        if (sortingParentSide == "l") sortedEntriesIds = sortedEntriesIds.concat(sortedArray).concat(sortingArrays[sortingParentNo]["pivot"]);
        else sortedEntriesIds = sortedEntriesIds.concat(sortedArray);
        nextSortingLevel();
        return;
    }
    if (sortingPivot == undefined) {
        sortingPivot = sortedArray[Math.floor(sortedArray.length / 2)];
        sortingArrays[currentSortingArrayIndex]["pivot"] = sortingPivot;
    }
    let pivotIndex = sortedArray.findIndex(id => id == sortingPivot);

    let additionalLArray = sortedArray.slice(0, pivotIndex);
    let additionalRArray = sortedArray.slice(pivotIndex + 1);
    if (additionalLArray.length > 0) sortingArrays[currentSortingArrayIndex]["lSorted"] = false;
    if (additionalRArray.length > 0) sortingArrays[currentSortingArrayIndex]["rSorted"] = false;
    if (sortingLArray.length == 0) sortingArrays[currentSortingArrayIndex]["lSorted"] = true;
    if (sortingRArray.length == 0) sortingArrays[currentSortingArrayIndex]["rSorted"] = true;
    let lSorted = sortingArrays[currentSortingArrayIndex]["lSorted"];
    let rSorted = sortingArrays[currentSortingArrayIndex]["rSorted"];
    sortingLArray = sortingLArray.concat(additionalLArray);
    sortingRArray = sortingRArray.concat(additionalRArray);
    sortingArrays[currentSortingArrayIndex]["lArray"] = sortingLArray;
    sortingArrays[currentSortingArrayIndex]["rArray"] = sortingRArray;

    if (currentSortingArray["array"].length == 0) {
        sortingArrays[currentSortingArrayIndex * 2 + 1] = { "array": sortingLArray, "parentNo": currentSortingArrayIndex, "parentSide": "l" };
        sortingArrays[currentSortingArrayIndex * 2 + 2] = { "array": sortingRArray, "parentNo": currentSortingArrayIndex, "parentSide": "r" };
        if (sortingLArray.length < 2 || lSorted) {
            sortedEntriesIds = sortedEntriesIds.concat(sortingLArray).concat(sortingArrays[currentSortingArrayIndex]["pivot"]);
            if (sortingRArray.length < 2 || rSorted) {
                sortedEntriesIds = sortedEntriesIds.concat(sortingRArray);
                nextSortingLevel();
                return;
            } else {
                currentSortingArrayIndex = currentSortingArrayIndex * 2 + 2;
                nextSorting();
            }
        } else {
            currentSortingArrayIndex = currentSortingArrayIndex * 2 + 1;
            nextSorting();
        }
    } else {
        nextSorting(5, true);
    }
}

function clearContent() {
    let entry0Content = document.querySelector("#entry-0 .content").innerHTML;
    document.querySelectorAll(".entry").forEach(entryElement => {
        entryElement.setAttribute("entry-id", -1);
        entryElement.querySelector(".content").innerHTML = entry0Content;
    })
}

function readSorted() {
    var sorted = Array.from(document.querySelectorAll(".entry")).map(el => el.getAttribute("entry-id")).filter(id => id >= 0);
    return sorted;
}

function focusImage(el) {
    el.parentElement.parentElement.parentElement.querySelector(".image img").setAttribute("src", el.getAttribute("src"));
}

function fill(array) {
    let currentEntries = array.map(index => entries[index]);
    for (let i = 0; i < 5; i++) {
        let entry = currentEntries[i];
        let entryElement = document.getElementById("entry-" + (i + 1));
        if (entry == undefined) {
            entryElement.setAttribute("entry-id", -1);
            continue;
        }
        entryElement.setAttribute("entry-id", array[i]);
        entryElement.querySelector(".name span").innerHTML = entry[0];
        let minatures = entryElement.querySelectorAll(".min-image img");
        for (let j = 0; j < minatures.length; j++) {
            minatures[j].setAttribute("src", entry[j + 1]);
        }
        let mainImageElement = entryElement.querySelector(".image img");
        mainImageElement.setAttribute("src", entry[1]);
    }
}

function swapContent(entry1, entry2) {
    let entry1Element = document.querySelector("#entry-" + entry1);
    let entry2Element = document.querySelector("#entry-" + entry2);
    let shiftDif = entry2 - entry1;
    let entry1Content = entry1Element.querySelector(".content").innerHTML;
    let entry1Id = entry1Element.getAttribute("entry-id");
    if (Math.abs(shiftDif) == 1) {
        entry1Element.querySelector(".content").innerHTML = entry2Element.querySelector(".content").innerHTML;
        entry1Element.setAttribute("entry-id", entry2Element.getAttribute("entry-id"));

    } else if (shiftDif < -1) {
        for (let i = entry1; i > entry2; i--) {
            swapContent(i, i - 1);
        }
    } else if (shiftDif > 1) {
        for (let i = entry1; i < entry2; i++) {
            swapContent(i, i + 1);
        }
    }
    entry2Element.querySelector(".content").innerHTML = entry1Content;
    entry2Element.setAttribute("entry-id", entry1Id);
}

function onWindowLoad() {
    let buttons = [];
    let buttonsCheck = setInterval(() => {
        buttons = document.querySelectorAll(".mover button:not([class*='submit'])");
        if (buttons.length > 0) {
            clearInterval(buttonsCheck);

            buttons.forEach(button => {
                button.addEventListener("click", () => {
                    let entryId = button.parentElement.parentElement.getAttribute("id");
                    entryId = Number(entryId[entryId.length - 1]);
                    let otherEntryId;
                    switch (button.className) {
                        case "left":
                            otherEntryId = Math.max(entryId - 1, 1);
                            break;
                        case "left-end":
                            otherEntryId = 1;
                            break;
                        case "right":
                            otherEntryId = Math.min(entryId + 1, 5);
                            break;
                        case "right-end":
                            otherEntryId = 5;
                            break;
                        default:
                            break;
                    }
                    swapContent(entryId, otherEntryId);
                });
            })
        }
    }, 200);
}