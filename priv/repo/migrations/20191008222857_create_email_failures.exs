defmodule Coyote.Repo.Migrations.CreateEmailFailures do
  use Ecto.Migration

  def change do
    create table(:email_failures) do
      add :user_id, references(:users)
      add :error, :text
      add :resolved, :utc_datetime

      timestamps()
    end
  end
end
