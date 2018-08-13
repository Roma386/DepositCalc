<html>
<head>
<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
<title>Калькулятор банковского вклада</title>
</head>
<body>
<h3>Калькулятор банковского вклада:</h3>
<form action="deposit.php" method="POST">
<br>Сумма вклада: <input type="text" name="summ" value="<?=$_POST["summ"]?>">

<br>Срок: <select id="selectvalue" name ="period">
    <option selected="selected"><?=$_POST["period"]?></option>
    <option value = "3">3 месяца</option>
    <option value = "6">6 месяцев</option>
    <option value = "9">9 месяцев</option>
    <option value = "12">1 год</option>
    <option value = "18">1,5 года</option>
    <option value = "24">2 года</option>
    <option value = "30">2,5 года</option>
    <option value = "36">3 года</option>
    <option value = "60">5 лет</option>
    <option value = "120">10 лет</option>
</select> 

<br>Возможность пополнения:<input name="replenishment" type="radio" value="yes" <? if ($_POST['replenishment'] == "yes"){echo "checked";} ?>>Да 
    <input name="replenishment" type="radio" value="no" <? if ($_POST['replenishment'] == "no"){echo "checked";} ?>>Нет
    
<br>Частичное снятие:<input name="withdrawal" type="radio" value="yes" <? if ($_POST['withdrawal'] == "yes"){echo "checked";} ?>>Да 
    <input name="withdrawal" type="radio" value="no" <? if ($_POST['withdrawal'] == "no"){echo "checked";} ?>>Нет

<br><input type="submit" value="Расчитать">
</form>
<?php

//Обработка формы
//1. Проверяем, есть ли переменная summ
if (isset($_POST['summ']))
{
    //Выполняем проверку полей на заполнение
    if ($_POST['summ'] == ""){
    echo "! Введите сумму";
    exit();
    }
    elseif ($_POST['period'] == ""){
    echo "! Укажите период";
    exit();
    }
    elseif ($_POST['replenishment'] == ""){
    echo "! Укажите условия";
    exit();
    }
    elseif ($_POST['withdrawal'] == ""){
    echo "! Укажите условия";
    exit();
    }
//2. Записываем значения переменных из формы	
$summ = $_POST['summ'];
$period = $_POST['period'];
//3. Указываем базовую процентную ставку по вкладу (4.5%)
$percent = 4.5;
//4. Увеличиваем базовый процент, если не будет пополнения счета и частичного снятия средств (проверка полей с radiobutton)
if ($_POST['replenishment'] == "no"){$percent += 0.4;}
if ($_POST['withdrawal'] == "no"){$percent += 1.2;}

echo '<br><b>Доход:</b>';
//5. Вычисляем процент по вкладу в месяц
$month_percent = $percent / 12;
//6. Запускаем цикл по количеству месяцев
for ($i=1; $i<=$period1; $i++){
    //на каждом шаге цикла выводим месячный доход
    $month_summ = ($summ/100)*$month_percent;
    echo '<br>'.$i."-й месяц, доход: ";
    echo round($month_summ, 2);
    //прибавляем месячный доход к общей сумме
    $summ= $summ + $month_summ;
    echo ". Остаток на счете: ";
    echo round($summ, 2);
    }
//7. Выводим итоговый результат
$result = round($summ, 2);
echo '<br><b>Результат:</b>';
echo '<br>'."Годовая процентная ставка: "."$percent"."%";
echo '<br>'."Сумма на конец периода: "."$result"." руб.";
}
?>
</body>
</html>
