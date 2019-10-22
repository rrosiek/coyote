defmodule Coyote.Repo.Migrations.CreateRoles do
  use Ecto.Migration

  def change do
    create table(:roles) do
      add :level, :integer, null: false
      add :name, :string, null: false
    end
  end
end
