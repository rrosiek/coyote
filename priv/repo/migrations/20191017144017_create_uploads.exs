defmodule Coyote.Repo.Migrations.CreateUploads do
  use Ecto.Migration

  def change do
    create table(:uploads) do
      add :file_name, :string
      add :file_path, :string
      add :size, :integer
      add :mime, :string
      add :token, :string
      add :uploadable_id, :integer
      add :uploadable_type, :string

      timestamps()
    end
  end
end
