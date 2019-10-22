defmodule Coyote.Repo.Migrations.CreateCorrespondence do
  use Ecto.Migration

  def change do
    create table(:correspondence) do
      add :user_id, references(:users)
      add :subject, :string
      add :body, :text
      add :opens, :integer, default: 0
      add :deliveries, :integer, default: 0

      timestamps()
    end
  end
end
