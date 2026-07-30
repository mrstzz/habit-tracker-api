#Habit Tracker Api

Tabela guardar os nossos habits


<!--tabelas: no ingles e no plural -->

Tabela: habits
Model: Habit => representação de um registro da tabela
    -> title

Tabela: habit_logs
Model: HabitLog => colocar o dia que completamos aql hábito
    -> habit_id : foreign id 
    -> completed_at: datetime