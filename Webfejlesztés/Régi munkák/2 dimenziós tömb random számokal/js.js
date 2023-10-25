function $(id) {
    return document.getElementById(id);
}
function tombs2D() {
    cols = 10;
    rows = 10;

    front = new Array(cols)// .fill(new Array(rows));

    // Loop through Initial array to randomly place cells
    for (var x = 0; x < cols; x++) {
        front[x] = [];  // ***** Added this line *****
        for (var y = 0; y < rows; y++) {
            front[x][y] = Math.floor(Math.random() * 5);
        }
    }
}