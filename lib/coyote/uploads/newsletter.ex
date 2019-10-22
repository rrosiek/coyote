defmodule Coyote.Uploads.Newsletter do
  use Ecto.Schema
  import Ecto.Changeset

  schema "newsletters" do
    field :name, :string

    timestamps()
  end

  @doc false
  def changeset(newsletter, attrs) do
    newsletter
    |> cast(attrs, [:name])
    |> validate_required([:name])
  end
end
