defmodule Coyote.Repo.Migrations.CreateBrotherRelations do
  use Ecto.Migration

  def change do
    create table(:brother_relations) do
      add :user_id, references(:users)
      add :little_id, references(:users)
    end
  end
end
