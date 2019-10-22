defmodule Coyote.Repo.Migrations.CreateFiles do
  use Ecto.Migration

  def change do
    create table(:files) do
      add :description, :string

      timestamps()
    end

  end
end
