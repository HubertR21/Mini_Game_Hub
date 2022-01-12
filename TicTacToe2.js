const statusDisplay = document.querySelector('.game--status');
let gameActive = true;
let currentPlayer = "X";
let gameState = ["", "", "", "", "", "", "", "", ""];
var MyTurn=null
var CheckTurn=null

var InitialData = (function() {
    var result;
    $.ajax({
        type:'GET',
        url:'InitialInfo.php',
        dataType:'json',
        async:false,
        success:function(data){
            result = data;
        }
        });
        return result;
    })();

var MyId=(function() {
        var result;
        $.ajax({
            type:'GET',
            url:'MyId.php',
            dataType:'json',
            async:false,
            success:function(data){
                result = data;
            }
        });
        return result;
    })();
    MyId=parseInt(MyId)

console.log(InitialData[0]);
function CheckTurnEverySec(){
    $.ajax({
    type:'POST',
    url:'CheckTurn.php',
    dataType:'json',
    data:{user1:InitialData[0]['user1'],user2:InitialData[0]['user2']},
    async:false,
    success:function(data){
        CheckTurn = data;
    }
    });


    if (MyId==parseInt(CheckTurn[0]["user"+CheckTurn[0].turn])){
        MyTurn=true;
        last_move=parseInt(CheckTurn[0].last_move)
        if (!Number.isNaN(last_move)){
            console.log(last_move)  
            console.log(typeof(last_move))   
            console.log(document.querySelectorAll('.cell'))
            //document.querySelectorAll('.cell')[last_move].click();
            if(gameState[last_move] == ""){
                gameState[last_move] = currentPlayer;
                document.querySelectorAll('.cell')[last_move].innerHTML = currentPlayer;
                handleResultValidation();
            }
        }
    }else{
        
        MyTurn=false}
    console.log(CheckTurn[0])
    console.log(MyTurn);
}
var t=setInterval(CheckTurnEverySec,500);




const winningMessage = () => `Player ${currentPlayer} has won!`;
const drawMessage = () => `Game ended in a draw!`;
//const currentPlayerTurn = () => `It's ${currentPlayer}'s turn`;
const currentPlayerTurn = () => `It's ${(MyTurn) ? "your": "enemy"} turn`;
statusDisplay.innerHTML = currentPlayerTurn();

const winningConditions = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
];

    

function handleCellPlayed(clickedCell, clickedCellIndex, flag) {
    gameState[clickedCellIndex] = currentPlayer;
    clickedCell.innerHTML = currentPlayer;
    $.ajax({
        type:'POST',
        url:'SendMove.php',
        data:{id: InitialData[0]['id'],
            user1: InitialData[0]['user1'],
            user2: InitialData[0]['user2'],
            turn:(CheckTurn[0]['turn']=="1")?"2":"1",
            last_move:clickedCellIndex
        },
        async:false,
        success:function(data){
            console.log(data)
        }
        });
    }
function handlePlayerChange() {
    currentPlayer = currentPlayer === "X" ? "O" : "X";
    statusDisplay.innerHTML = currentPlayerTurn();
}

function handleResultValidation() {
    let roundWon = false;
    for (let i = 0; i <= 7; i++) {
        const winCondition = winningConditions[i];
        let a = gameState[winCondition[0]];
        let b = gameState[winCondition[1]];
        let c = gameState[winCondition[2]];
        if (a === '' || b === '' || c === '') {
            continue;
        }
        if (a === b && b === c) {
            roundWon = true;
            break
        }
    }

    if (roundWon) {
        statusDisplay.innerHTML = winningMessage();
        gameActive = false;
        return;
    }

    let roundDraw = !gameState.includes("");
    if (roundDraw) {
        statusDisplay.innerHTML = drawMessage();
        gameActive = false;
        return;
    }

    handlePlayerChange();
}

function handleCellClick(clickedCellEvent) {
    const clickedCell = clickedCellEvent.target;
    const clickedCellIndex = parseInt(clickedCell.getAttribute('data-cell-index'));

    if (gameState[clickedCellIndex] !== "" || !gameActive || MyTurn==false) {
        return;
    }

    handleCellPlayed(clickedCell, clickedCellIndex);
    handleResultValidation();
}

function handleRestartGame() {
    gameActive = true;
    currentPlayer = "X";
    gameState = ["", "", "", "", "", "", "", "", ""];
    statusDisplay.innerHTML = currentPlayerTurn();
    document.querySelectorAll('.cell').forEach(cell => cell.innerHTML = "");
}


document.querySelectorAll('.cell').forEach(cell => cell.addEventListener('click', handleCellClick));
document.querySelector('.game--restart').addEventListener('click', handleRestartGame);
