defmodule Coyote.Repo.Migrations.CreateMinutes do
  use Ecto.Migration

  def change do
    create table(:minutes) do
      add :meeting_date, :naive_datetime

      timestamps()
    end

  end
end
