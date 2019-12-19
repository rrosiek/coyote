defmodule Coyote.Repo.Migrations.CreateBrotherRelations do
  use Ecto.Migration

  def change do
    create table(:brother_relations) do
      add :user_id, references(:users, on_delete: :delete_all)
      add :little_id, references(:users, on_delete: :delete_all)
    end
  end
end
