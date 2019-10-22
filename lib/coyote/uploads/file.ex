defmodule Coyote.Uploads.File do
  use Ecto.Schema
  import Ecto.Changeset

  schema "files" do
    field :description, :string

    timestamps()
  end

  @doc false
  def changeset(file, attrs) do
    file
    |> cast(attrs, [:description])
    |> validate_required([:description])
  end
end
